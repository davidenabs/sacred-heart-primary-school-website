@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" class="logo" alt="{{ Config('app.name') }} Logo">
@else
<img src="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" class="logo" alt="{{ Config('app.name') }} Logo">
@endif
</a>
</td>
</tr>
