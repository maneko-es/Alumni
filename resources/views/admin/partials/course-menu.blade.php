<table class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid">
    <tbody>
        <?php App::setLocale($locale); ?>
        <tr role="row" class="odd">
            <td tabindex="0">
                <a href="{{ url('admin/course/'.$course->id.'/edit?locale='.$locale) }}"><b style="text-transform: uppercase;">{{ $course->title }}</b></a>
            </td>
            <td width="80" style="text-transform: uppercase;">
                <?php echo getMultilanguageEditButtons('course',$course->id,$course); ?>
            </td>
        </tr>
        @foreach($course->modules()->orderBy('order')->get() as $module)
            <tr role="row" class="odd" <?php if($entry->course_id && $entry->id == $module->id){ echo 'style="background-color: #cecece"'; } ?>>
                <td tabindex="0">
                    - <a href="{{ url('admin/module/'.$module->id.'/edit?locale='.$locale) }}">{{ $module->title }}</a>
                </td>
                <td width="80" style="text-transform: uppercase;">
                    <?php echo getMultilanguageEditButtons('module',$module->id,$module); ?>
                </td>
            </tr>
            @foreach($module->lessons()->get() as $lesson)
                <tr role="row" class="odd" <?php if($entry->module_id && $entry->id == $lesson->id){ echo 'style="background-color: #cecece"'; } ?>>
                    <td tabindex="0">
                        --- <a href="{{ url('admin/lesson/'.$lesson->id.'/edit?locale='.$locale) }}">{{ $lesson->title }}</a>
                    </td>
                    <td width="80" style="text-transform: uppercase;">
                        <?php echo getMultilanguageEditButtons('lesson',$lesson->id,$lesson); ?>
                    </td>
                </tr>
            @endforeach
        @endforeach
   </tbody>
</table>