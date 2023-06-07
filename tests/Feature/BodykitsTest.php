<?php

use App\Models\BodykitShop;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Bodykit;

use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\put;
use function PHPUnit\Framework\assertEquals;

it('bodykits/ GET', function () {
    $response = get('/api/v1/bodykits');

    $response->assertStatus(200);

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data');
    });
});

it('bodykits/{id} GET correct id', function() {
    $bodykit_shop = BodykitShop::factory()->createOne();
    $bodykit_shop->save();


    $bodykit = new Bodykit(['version' => 'RoketBunny',
                          'name' => 'Nissan skyline r32',
                          'manufacture_year' => 2023,
                          'bodykit_shop_id' => $bodykit_shop->id]);
    $bodykit->save();

    $response = get('/api/v1/bodykits/' . $bodykit->id);
    $json = $response->decodeResponseJson();
    $data = $json['data'];

    assertEquals($bodykit->version, $data['version']);
    assertEquals($bodykit->name, $data['name']);
    assertEquals($bodykit->manufacture_year, $data['manufacture_year']);
    assertEquals($bodykit->bodykit_shop->id, $data['bodykit_shop_id']);

    $bodykit->delete();
    $bodykit_shop->delete();
});

it('bodykit/{id} GET incorrect id', function() {
    $response = get('/api/v1/bodykits/-1');
    $response->assertStatus(404);

    $json = $response->decodeResponseJson();
    assertEquals(404, $json['code']);
});

it('bodykits/ POST correct data', function() {
    $bodykit_shop = BodykitShop::factory()->createOne();
    $bodykit_shop->save();


    $response = $this->postJson('/api/v1/bodykits', [
        "name" => "Buddy Club",
        "manufacture_year" => 2022,
        "version" => "Civic EK Hatch 96-98",
        "bodykit_shop_id" => $bodykit_shop->id,
    ]);
    $response->assertStatus(201);

    $json = $response->decodeResponseJson();
    $data = $json['data'];

    $bodykit = Bodykit::query()->find($data['id']);
    assertEquals("Buddy Club", $bodykit->name);
    assertEquals(2022, $bodykit->manufacture_year);
    assertEquals("Civic EK Hatch 96-98", $bodykit->shape);
    assertEquals($bodykit_shop->id, $bodykit->bodykit_shop_id);

    $bodykit->delete();
    $bodykit_shop->delete();
});

it('bodykits/ POST version validation', function() {
    $bodykit_shop = BodykitShop::factory()->createOne();
    $bodykit_shop->save();

    $response = $this->postJson('/api/v1/bodykits', [
        'name' => 'Top-Tuning',
        'manufacture_year' => 2006,
        'bodykit_shop_id' => $bodykit_shop->id,
    ]);
    $response->assertStatus(400);

    $json = $response->decodeResponseJson();
    assertEquals(400, $json['code']);

    $bodykit_shop->delete();
});

it('bodykits/{id} DELETE correct id', function() {
    $bodykit_shop = BodykitShop::factory()->createOne();
    $bodykit_shop->save();

    $bodykit = new Bodykit(['version' => 'Toyota Celica T23',
                          'name' => 'RoketBunny',
                          'manufacture_year' => 2021,
                          'bodykit_shop_id' => $bodykit_shop->id]);
    $bodykit->save();

    $response = delete('/api/v1/bodykits/' . $bodykit->id);
    $response->assertStatus(200);

    $found_bodykit = Bodykit::query()->find($bodykit->id);
    assertEquals(null, $found_bodykit);

    $bodykit_shop->delete();
});

it('bodykits/{id} DELETE incorrect id', function() {
    $response = delete('/api/v1/bodykits/-1');
    $response->assertStatus(404);

    $json = $response->decodeResponseJson();
    assertEquals(404, $json['code']);
});

it('bodykits/{id} PUT correct id', function() {
    $bodykit_shop = BodykitShop::factory()->createOne();
    $bodykit_shop->save();

    $bodykit = new Bodykit(['version' => 'Honda CR-Z',
                          'name' => 'Buddy Club',
                          'manufacture_year' => 2023,
                          'bodykit_shop_id' => $bodykit_shop->id]);
    $bodykit->save();

    $bodykit_shop1 = BodykitShop::factory()->createOne();
    $bodykit_shop1->save();

    $response = $this->putJson('/api/v1/bodykits/' . $bodykit->id, [
        'version' => 'Honda CR-Z',
        'name' => 'Buddy Club',
        'manufacture_year' => 2023,
        'bodykit_shop_id' => $bodykit_shop1->id]);
    $response->assertStatus(200);

    $json = $response->decodeResponseJson();
    $data = $json['data'];

    $bodykit = Bodykit::query()->find($data['id']);
    assertEquals('Honda CR-Z', $bodykit->shape);
    assertEquals('Buddy Club', $bodykit->name);
    assertEquals(2023, $bodykit->manufacture_year);
    assertEquals($bodykit_shop1->id, $bodykit->bodykit_shop_id);

    $bodykit_shop1->delete();
    $bodykit->delete();
    $bodykit_shop->delete();
});

it('bodykits/{id} PUT incorrect id', function() {
    $bodykit_shop = BodykitShop::factory()->createOne();
    $bodykit_shop->save();

    $response = $this->putJson('/api/v1/bodykits/-1', [
        'version' => 'Honda CR-Z',
        'name' => 'Buddy Club',
        'manufacture_year' => 2023,
        'bodykit_shop_id' => $bodykit_shop->id]);
    $response->assertStatus(404);

    $json = $response->decodeResponseJson();
    assertEquals(404, $json['code']);

    $bodykit_shop->delete();
});

it('bodykits/{id} PATCH correct id', function() {
    $bodykit_shop = BodykitShop::factory()->createOne();
    $bodykit_shop->save();


    $bodykit = new Bodykit(['version' => 'Toyota Altezza',
                          'name' => 'Top-Tuning',
                          'manufacture_year' => 2022,
                          'bodykit_shop_id' => $bodykit_shop->id]);
    $bodykit->save();

    $response = $this->patchJson('/api/v1/bodykits/' . $bodykit->id, [
        'name' => 'Rocket Bunny'
    ]);
    $response->assertStatus(200);

    $json = $response->decodeResponseJson();
    $data = $json['data'];


    $bodykit = Bodykit::query()->find($data['id']);
    assertEquals('Silvia s15', $bodykit->version);
    assertEquals('Rocket Bunny', $bodykit->name);
    assertEquals(2023, $bodykit->manufacture_year);
    assertEquals($bodykit_shop->id, $bodykit->bodykit_shop_id);

    $bodykit->delete();
    $bodykit_shop->delete();
});

it('bodykits/{id} PATCH incorrect id', function() {
    $response = patch('/api/v1/bodykits/-1');
    $response->assertStatus(404);

    $json = $response->decodeResponseJson();
    assertEquals(404, $json['code']);
});
