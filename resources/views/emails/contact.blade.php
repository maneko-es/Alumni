<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<body style="background-color: #f4f4f4; font-family: Tahoma, sans-serif; font-size: 18px;">
	<div style="width: 750px; margin: 0 auto; background-color: white;">
		<img src="{{ url('images/mailing/header.png') }}">

		<div style="padding: 60px 30px 50px">

		    <h1 style="font-family: serif; font-weight: 400; color: #144577; margin-bottom: 40px; margin-top: 0px;">
			    Comentari rebut a la pàgina<br>de contacte d’Alumni
			</h1>

		    <p style="margin-bottom: 30px; line-height: 1.5em">Hem rebut el següent missatge:</p>
		    <p style="margin-bottom: 30px; line-height: 1.5em">
		    	<b>{{ $form['name'] }}</b><br>
		    	{{ $form['email'] }}<br>
		    	{{ $school->title }}
		    </p>
		    <p style="margin-bottom: 0px; line-height: 1.5em">{{ $form['message'] }}</p>
		</div>

	    <img src="{{ url('images/mailing/footer.png') }}">
	</div>
</body>

</html>