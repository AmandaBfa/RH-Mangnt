<?php

use App\Models\User;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('tests if an admin can insert a new Rh user', function () {
    // criar user admin
    addAdminUser(); // por estar na função teste, ele tambem esta disponivel nesse arquivo

    // criar os departamentos
    addDepartment('Administração');
    addDepartment('Recursos Humanos');

    // login com o admin
    $result = $this->post('/login', [
        'email' => 'admin@rhmangnt.com',
        'password' => 'Aa123456'
    ]);

    // verifica se o login foi feito com sucesso
    expect($result->status())->toBe(302);
    expect($result->assertRedirect('/home'));

    // verifica se o admin consegue adicionar user de rh
    $result = $this->post('/rh-users/create-colaborator', [
        'name' => 'RH user 1',
        'email' => 'rhuser@gmail.com',
        'select_department' => 2,
        'address' => 'Rua 1',
        'zip_code' => '1234-123',
        'city' => '1234-City 1',
        'phone' => '123456789',
        'salary' => '1000.00',
        'admission_date' => "2021-01-10",
        'role' => 'rh',
        'permissions' => '["rh"]',
    ]);

    // verifica se o user rh foi inserido com sucesso
    $this->assertDatabaseHas('users', [
        'name' => 'RH user 1',
        'email' => 'rhuser@gmail.com',
        'role' => 'rh',
        'permissions' => '["rh"]',
    ]);
});

function addDepartment($name)
{
    Department::insert([
        'name' => $name,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
