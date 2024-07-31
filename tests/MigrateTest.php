<?php

use Illuminate\Support\Facades\Schema;

it('can migrate', function () {
    expect(Schema::hasTable('stored_events'))->toBeTrue();
});
