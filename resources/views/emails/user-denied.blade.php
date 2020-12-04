<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<body style="background-color: #f4f4f4; font-family: Tahoma, sans-serif; font-size: 18px;">
	<div style="width: 750px; margin: 0 auto; background-color: white;">
		<div style="padding: 35px 30px 0 30px; border-top: 5px solid {{ $school->color }}">
			<table style="width: 100%;">
				<tr>
					<td><img style="height: 30px; width: auto;" src="{{ url('images/mailing/school_'.$school->id.'.svg') }}"></td>
					<td style="text-align: right;"><a style=" font-weight: bold; color: black; text-decoration: none; font-size: 15px;" target="_blank" href="{{ url('/') }}">www.iccic.edu/alumni</a></td>
				</tr>
			</table>
		</div>
		

		<div style="padding: 80px 30px 50px">

		    <h1 style="font-family: serif; font-weight: 400; margin-bottom: 40px; margin-top: 0px;">
			    Sol·licitud ICCIC Alumni
			</h1>

		    <p style="margin-bottom: 30px; line-height: 1.5em; max-width: 400px;">
		    	La seva sol·licitud no ha estat acceptada. Posi's en contacte amb l’escola en el correu 
		    	<a href="mailto:{{ $school->email }}"> {{ $school->email }} </a>
		    </p>
		    
		</div>

	    <img src="{{ url('images/mailing/footer.png') }}">
	</div>
</body>

</html>