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

    // // verifica se o user rh foi inserido com sucesso
    // $this->assertDatabaseHas('users', [
    //     'name' => 'RH user 1',
    //     'email' => 'rhuser@gmail.com',
    //     'role' => 'rh',
    //     'permissions' => '["rh"]',
    // ]);
    expect(User::where('email', 'rhuser@gmail.com'));
});

it('tests if an RH User can insert a new Colaborator User', function () {
    // criar user rh
    addRhUser(); // por estar na função teste, ele tambem esta disponivel nesse arquivo

    // criar os departamentos
    addDepartment('Administração');
    addDepartment('Recursos Humanos');
    addDepartment('Armazém');

    // login com o RH
    $this->post('/login', [
        'email' => 'rh1@rhmangnt.com',
        'password' => 'Aa123456'
    ]);

    // verifica se o login foi feito com sucesso
    expect(auth()->user()->role)->toBe('rh');

    // verifica se o admin consegue adicionar user de rh
    $result = $this->post('/rh-users/management/create-colaborator', [
        'name' => 'Colaborator 1',
        'email' => 'colaborator1@gmail.com',
        'select_department' => 3,
        'address' => 'Rua 2',
        'zip_code' => '1234-000',
        'city' => 'City 2',
        'phone' => '123456789',
        'salary' => '1000.00',
        'admission_date' => "2025-06-09",
        'role' => 'colaborator',
        'permissions' => '["colaborator"]'
    ]);

    // verifica se o user rh foi inserido com sucesso
    // $this->assertDatabaseHas('users', [
    //     'email' => 'colaborator1@gmail.com',
    // ]);
    expect(User::where('email', 'colaborator1@gmail.com'));
});

function addDepartment($name)
{
    Department::insert([
        'name' => $name,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
