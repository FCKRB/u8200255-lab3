<?php

use App\Models\BodykitShop;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\get;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

it('bodykit-shops/ GET', function () {
    $response = get('/api/v1/bodykit-shops');

    $response->assertStatus(200);

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data');
    });
});

it('bodykit-shops/{id} GET correct id', function() {
    $shop = BodykitShop::factory()->createOne();

    $response = get('/api/v1/bodykit-shops/' . $shop->id);
    $response->assertStatus(200);

    $json = $response->decodeResponseJson()['data'];
    assertEquals($shop->name, $json['name']);
    assertEquals($shop->address, $json['address']);
    assertEquals($shop->bodykit_capacity, $json['bodykit_capacity']);

    $shop->delete();
});

it('bodykit-shops/ POST correct data', function() {
    $response = $this->postJson('/api/v1/bodykit-shops', [
        "name" => 'Bodykit shop 1',
        "address" => 'Test st., 5',
        "bodykit_capacity" => 5,
    ]);
    $response->assertStatus(201);

    $shop = BodykitShop::query(
        )->where(
            'name', '=', 'Bodykit shop 1'
        )->where(
            'address', '=', 'Test st., 5'
        )->where(
            'bodykit_capacity', '=', 5
        )->first();
    assertNotNull($shop);

    $shop->delete();
});
