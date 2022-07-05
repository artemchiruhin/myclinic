<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://sun9-46.userapi.com/s/v1/ig2/jZG9jQfJO7o87UwuBmG_BuuJjTCthGyt1rQdJxzwrPSp5slzs0LFpwbKhbRxMB8GBXxu73zl6pFGIiA_O0IYgZQg.jpg?size=646x212&quality=96&type=album" class="logo" alt="MYCLINIC Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
