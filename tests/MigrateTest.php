<?php

use Illuminate\Support\Facades\Schema;

it('can test', function () {
    expect(Schema::hasTable('stored_events'))->toBeTrue();
});
