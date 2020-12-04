@if($id == 0)
	<div class="color-bar" style="position: absolute;bottom: 0;left: 0;">
		<div class="color1"></div><div class="color2"></div><div class="color3"></div><div class="color4"></div><div class="color5"></div><div class="color6"></div><div class="color7"></div>
	</div>
@else
	<div class="school-bottom-bar" style="background-color: {{ $s_color }}"></div>
@endif