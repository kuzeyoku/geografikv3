<td>
    {{ html()->form('PUT')->route("admin.{$route}.status_update", $item)->open() }}
    {{ html()->select('status', statusList(), $item->status)->class('form-control fw-bold mb-0 border-' . App\Enums\StatusEnum::fromValue($item->status)->color())->attribute('onchange', 'this.form.submit()') }}
    {{ html()->form()->close() }}
</td>
