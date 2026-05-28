<?php

namespace Tests\Feature\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionMatrixTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_area(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_customer_cannot_access_admin_reports(): void
    {
        $customer = $this->makeUserWithRole('customer');

        $this->actingAs($customer)
            ->get(route('admin.reports.index'))
            ->assertForbidden();
    }

    public function test_customer_cannot_access_cart_without_cart_permission(): void
    {
        $customer = $this->makeUserWithRole('customer');

        $this->actingAs($customer)
            ->get(route('cart.index'))
            ->assertForbidden();
    }

    public function test_customer_cannot_update_profile_without_profile_permission(): void
    {
        $customer = $this->makeUserWithRole('customer');

        $this->actingAs($customer)
            ->patch(route('profile.update'), [
                'name' => 'New Name',
                'email' => 'new@example.com',
            ])
            ->assertForbidden();
    }

    public function test_staff_with_report_permission_can_access_reports_and_see_menu_item(): void
    {
        $this->makePermission('report.view', 'View reports', 'report');
        $staff = $this->makeUserWithRole('staff', ['report.view']);

        $response = $this->actingAs($staff)->get(route('admin.reports.index'));

        $response->assertOk();
        $response->assertSee('Báo cáo');
    }

    public function test_admin_with_report_permission_can_access_reports(): void
    {
        $this->makePermission('report.view', 'View reports', 'report');
        $admin = $this->makeUserWithRole('admin', ['report.view']);

        $this->actingAs($admin)
            ->get(route('admin.reports.index'))
            ->assertOk();
    }

    public function test_staff_with_non_view_product_permission_can_access_products_index(): void
    {
        $this->makePermission('product.update', 'Update products', 'product');
        $staff = $this->makeUserWithRole('staff', ['product.update']);

        $this->actingAs($staff)
            ->get(route('admin.products.index'))
            ->assertOk();
    }

    public function test_customer_role_permission_page_hides_product_and_category_modules(): void
    {
        $this->makePermission('product.view', 'View products', 'product');
        $this->makePermission('category.view', 'View categories', 'category');

        $admin = $this->makeUserWithRole('admin', ['permission.assign']);
        $customer = $this->makeUserWithRole('customer', ['product.view', 'category.view']);

        $this->actingAs($admin)
            ->get(route('admin.roles.permissions.edit', $customer->roles()->first()))
            ->assertOk()
            ->assertDontSee('product.view')
            ->assertDontSee('category.view');
    }

    public function test_customer_role_permission_update_strips_product_and_category_permissions(): void
    {
        $productView = $this->makePermission('product.view', 'View products', 'product');
        $categoryView = $this->makePermission('category.view', 'View categories', 'category');
        $cartView = $this->makePermission('cart.view', 'View carts', 'cart');

        $admin = $this->makeUserWithRole('admin', ['permission.assign']);
        $customer = $this->makeUserWithRole('customer', ['product.view', 'category.view', 'cart.view']);

        $this->actingAs($admin)
            ->put(route('admin.roles.permissions.update', $customer->roles()->first()), [
                'permissions' => [$productView->id, $categoryView->id, $cartView->id],
            ])
            ->assertRedirect(route('admin.roles.index'));

        $customerRole = $customer->roles()->first();

        $this->assertFalse($customerRole->fresh()->permissions()->where('code', 'product.view')->exists());
        $this->assertFalse($customerRole->fresh()->permissions()->where('code', 'category.view')->exists());
        $this->assertTrue($customerRole->fresh()->permissions()->where('code', 'cart.view')->exists());
    }

    private function makeUserWithRole(string $roleCode, array $permissionCodes = []): User
    {
        $role = Role::query()->create([
            'name' => ucfirst($roleCode),
            'code' => $roleCode,
            'description' => null,
            'is_system' => true,
            'sort_order' => 0,
        ]);

        foreach ($permissionCodes as $code) {
            $permission = $this->makePermission($code, ucfirst(str_replace('.', ' ', $code)), explode('.', $code)[0]);
            $role->permissions()->attach($permission->id);
        }

        $user = User::factory()->create();
        $user->roles()->attach($role->id);

        return $user;
    }

    private function makePermission(string $code, string $name, string $module): Permission
    {
        return Permission::query()->firstOrCreate(
            ['code' => $code],
            [
                'name' => $name,
                'module' => $module,
                'description' => null,
            ]
        );
    }
}
