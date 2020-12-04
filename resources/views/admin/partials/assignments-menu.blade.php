@if($assignments)
<table class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid">
    <tbody>
        <?php App::setLocale($locale); ?>
        <tr role="row" class="odd">
            <td colspan="2" tabindex="0">
                <b style="text-transform: uppercase;">TAREAS</b>
            </td>
        </tr>
        @foreach($assignments as $assignment)
            <tr role="row" class="odd" <?php if($entry->id == $assignment->id){ echo 'style="background-color: #cecece"'; } ?>>
                <td tabindex="0">
                    <a href="{{ url('admin/assignment/'.$assignment->id.'/edit?locale='.$locale) }}">{{ $assignment->title }}</a>
                </td>
                <td width="80" style="text-transform: uppercase;">
                    <?php echo getMultilanguageEditButtons('assignment',$assignment->id,$assignment); ?>
                </td>
            </tr>
        @endforeach
   </tbody>
</table>
@endif