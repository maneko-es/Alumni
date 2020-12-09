<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<body style="background-color: #f4f4f4; font-family: Tahoma, sans-serif; font-size: 18px;">
	<div style="width: 750px; margin: 0 auto; background-color: white;">
		<img src="{{ url('images/mailing/header.png') }}">

		<div style="padding: 60px 30px 50px">

		    <h1 style="font-family: serif; font-weight: 400; color: #144577; margin-bottom: 40px; margin-top: 0px;">
			    Nova sol·licitud per a<br>la xarxa ICCIC Alumni
			</h1>

		    <p style="margin-bottom: 30px; line-height: 1.5em">Hem rebut la següent sol·licitud:</p>
		    <p style="margin-bottom: 30px; line-height: 1.5em">
		    	<b>{{ $registry->name }}</b><br>
		    	{{ $registry->email }}<br>
		    	{{ $school->title }}<br>
		    	Promoció {{ $registry->year }}
		    </p>
		    <a href="{{ url('admin/registry/'.$registry->id.'/edit') }}"
		    	style="display: block; width: 233px; padding: 20px 40px; border: 1px solid #144577; text-transform: uppercase; font-size: 15px; text-align: center; text-decoration: none; color: #144577; margin-top: 60px;"
		    	>Validar sol·licitud</a>
		</div>

	    <img src="{{ url('images/mailing/footer.png') }}">
	</div>
</body>

</html>
