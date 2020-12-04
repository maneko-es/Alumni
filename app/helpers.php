<?php
use Illuminate\Database\Eloquent\Builder;
/**
 * If a key exists return it's value, if not, return an empty string
 *
 * @param  array $array
 * @param  string $key
 * @return string
 */
function checkKey($array, $key)
{
    return array_key_exists($key, $array) ? $array[$key] : '';
}

/**
 * Formats dates in the format provided or in the default format set in maravel config file
 *
 * @param  object $date
 * @param  string $format
 * @return string
 */
function formatDate($date, $format = '')
{
    if (!$format) {
        $format = config('maravel.primary_date_format');
    }

    return $date->format($format);
}
function formatStrDate($date, $format = '')
{
    $date = new DateTime($date);

    return $date->format($format);
}

/**
 * Gets an html move to trash button for datatables
 *
 * @param  string $page_name
 * @param  integer $id
 * @param  string $message
 * @return string
 */
function getTrashButton($page_name, $id, $message = '')
{
    $message = $message ? $message : rawUrlEncode(trans('messages.confirm_trash'));
    $data_url =  url('admin/' . $page_name . '/soft-delete/' . $id);

    return view('admin.partials.datatable-action', [
        'buttons' => [
            [
                'class' => 'fa fa-trash-o',
                'title' => trans('messages.delete'),
                'attribute' => 'data-delete data-delete-msg=' . $message . ' ' . 'data-url=' . $data_url,
            ]
        ]
    ])->render();
}

/**
 * Gets an html delete button for datatables
 *
 * @param  string $page_name
 * @param  integer $id
 * @param  string $message
 * @return string
 */
function getDeleteButton($page_name, $id, $message = '')
{

    $message = $message ? $message : rawUrlEncode(trans('messages.confirm'));
    $data_url = url('admin/' . $page_name . '/' . $id);

    return view('admin.partials.datatable-action', [
        'buttons' => [
            [
                'class' => 'fa fa-trash',
                'title' => trans('messages.delete'),
                'attribute' => 'data-delete data-delete-msg=' . $message . ' ' . 'data-url=' . $data_url,
            ]
        ]
    ])->render();
}

/**
 * Gets an html restore button for datatables
 *
 * @param  string $page_name
 * @param  integer $id
 * @return string
 */
function getRestoreButton($page_name, $id)
{
    return view('admin.partials.datatable-action', [
        'buttons' => [
            [
                'url' => url('admin/' . $page_name . '/restore/' . $id),
                'class' => 'fa fa-undo',
                'title' => trans('messages.restore'),
            ]
        ]
    ])->render();
}

/**
 * Gets an html edit button for datatables
 *
 * @param  string $page_name
 * @param  integer $id
 * @param  string $message
 * @return string
 */
function getEditButton($page_name, $id)
{
    return view('admin.partials.datatable-action', [
        'buttons' => [
            [
                'url' => url('admin/' . $page_name . '/' . $id . '/edit'),
                'class' => 'fa fa-pencil',
                'title' => trans('messages.edit'),
            ]
        ]
    ])->render();
}

/**
 * Gets an html multilanguage edit buttons for datatables
 *
 * @param  string $page_name
 * @param  integer $id
 * @param  object $model
 * @return string
 */
function getMultilanguageEditButtons($page_name, $id, $model)
{
    $buttons = [];

    foreach (config('app.locales') as $locale) {
        $is_translated = $model->hasTranslation($locale);

        $buttons[] = [
            'url' => url('admin/' . $page_name . '/' . $id . '/edit?locale=' . $locale),
            'class' => $is_translated ? '' : 'untranslated',
            'title' => trans('messages.edit'),
            'text' => $locale,
        ];
    }

    return view('admin.partials.datatable-action', ['buttons' => $buttons])->render();
}

/**
 * Gets an html with a modal edit link
 *
 * @param  string $page_name
 * @param  integer $id
 * @param  string $name
 * @return string
 */
function getEditUrl($page_name, $id, $name, $multilang = false)
{
    $lang_str = $multilang ? '/edit?locale=' . config('app.fallback_locale') : '/edit';

    $url = url('admin/' . $page_name . '/' . $id . $lang_str);

    return '<a href="' . $url . '">' . $name . '</a>';
}

/**
 * If URI matches patter return class name
 *
 * @param string|array $uri
 * @param string $class
 * @return string
 */
function setActiveNavbarLink($uri, $class = 'active')
{
    $uri = (array)$uri;

    foreach ($uri as $value) {
        if (Request::is($value)) {
            return $class;
        }
    }

    return '';
}

/**
 * Gets input value if entry exists.
 *
 * @param  object $entry
 * @param string $field
 * @param string $locale
 * @return string
 */
function getFormInput($entry, $field, $locale)
{
    $input = null;
    if ($entry) {
        $old = $entry->hasTranslation($locale) ? $entry->translate($locale)[$field] : '';
        $input = Input::old("{$locale}[$field]", $old);
    }
    return $input;
}

/**
 * Gets array with multilanguage routes.
 *
 * @return array
 */
function getMultilangRoutes()
{
    $route = Request::url();
    
    foreach (config('app.locales') as $k => $config_locale) {
        $elems[$k]['name'] = $config_locale;
        $elems[$k]['url'] = $route . '?locale=' . $config_locale;
    }
    return $elems;
}

/**
 * Return sizes readable by humans.
 *
 * @param  integer $bytes
 * @param  integer $decimals
 * @return string
 */
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$size[$factor];
}

/**
 * Gets datatables file row thumbnail
 *
 * @param  string $filepath
 * @param  string $mime
 * @return string
 */
function getThumbnail($filepath, $mime)
{
    if (strstr($mime, 'image/')) {
        return view('admin.partials.medias.thumbnail', [
            'filepath' => $filepath,
        ])->render();
    } else {
        if (strstr($mime, 'video/')) {
            $icon = 'fa-file-video-o';
        } elseif (strstr($mime, 'audio/')) {
            $icon = 'fa-file-audio-o';
        } elseif (strstr($mime, 'pdf') || strstr($mime, 'text')) {
            $icon = 'fa-file-text-o';
        } else {
            $icon = 'fa-file-o';
        }
        $name = explode('/', $filepath);
        $name = end($name);
        return view('admin.partials.medias.icon', [
            'icon' => $icon,
            'name' => $name,
        ])->render();
    }
}
function getThumbnailName($filepath, $mime, $name)
{
    if (strstr($mime, 'image/')) {
        return view('admin.partials.medias.thumbnail', [
            'filepath' => $filepath,
        ])->render();
    } else {
        if (strstr($mime, 'video/')) {
            $icon = 'fa-file-video-o';
        } elseif (strstr($mime, 'audio/')) {
            $icon = 'fa-file-audio-o';
        } elseif (strstr($mime, 'pdf') || strstr($mime, 'text')) {
            $icon = 'fa-file-text-o';
        } else {
            $icon = 'fa-file-o';
        }
        return view('admin.partials.medias.icon', [
            'icon' => $icon,
            'name' => $name,
        ])->render();
    }
}

function getMedia($entry)
{
    if(count($entry->medias) > 0){
        $media = $entry->medias[0];
        $url = url('media/original/'.$media->filename);
    } else {
        $url = '';
    }
    return $url;
}
function getMediaT($id)
{
    $mediat = App\MediaOriginal::find($id);
    return url(config('maravel.media_originals_folder'). "" . $mediat->filename);
}
function getLocaleMedia($entry)
{
    $locale = App::getLocale();
    if(count($entry->medias) > 0){
        $media = $entry->medias[0];

        if(count($entry->medias) > 1 && $locale == 'es'){
            $media = $entry->medias[1];
        }
        $url = url('media/original/'.$media->filename);

    } else {
        $url = url('img/placeholders/thumb.png');
    }
    return $url;
}
function getUserMedia($entry)
{
    $filename = $entry->profile_picture;
    $url = url('user-uploaded/profile-picture/'.$filename);
    
    return $url;
}
function cleanString($text) {
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}

function getCategory($entry){
    if($entry->category_id){
        $name = App\Category::find($entry->category_id)->title;
    } else {
        $name = '-';
    }
    return $name;
}
function getSchool($entry){
    if($entry->school_id){
        $schl = App\School::find($entry->school_id);
        $name = '<span class="school_tag school_'.$schl->id.'">'.$schl->title.'</span>';
    } else {
        $name = '-';
    }
    return $name;
}
function getPromotion($entry){
    if($entry->promotion_id){
        $promo = App\Promotion::find($entry->promotion_id);
        $name = $promo->title.' - '.$promo->school()->first()->title;
    } else {
        $name = '-';
    }
    return $name;
}
function getUserPromos($user){
    $promos = $user->promotions()->get();
    $ret = '';
    foreach($promos as $promo){
        $ret .= '<span class="school_tag school_'.$promo->school->id.'">'.$promo->school->title.' '.$promo->title.'</span>';
    }

    return $ret;
}

function getLang($lang){
    switch($lang){
        case 'es': $locale = "Español"; break;
        case 'en': $locale = "English"; break;
    }
    return $locale;
}

function getTranslatedUrl($locale,$url){
    if($locale == 'en'){
        $exurl = explode('/',$url);
        array_splice( $exurl, 3, 0, 'es' );
        $turl = implode('/',$exurl);
    } else {
        $turl = str_replace('/es/','/',$url);
        $turl = str_replace('/es','/',$turl);
    }
    return $turl;
}

function getTranslatedUrlSingle($locale,$post,$model){
    if($locale == 'es'){ $loc = 'en'; $locr = ''; } else { $loc = 'es'; $locr = 'es/'; }

    if($post->hasTranslation($loc)){
        if($model == 'post'){
            $slug = $post->translate($loc)->slug;
            $troute = url($locr.'news/'.$slug);
        }
        elseif($model == 'course'){
            $slug = $post->translate($loc)->slug;
            $troute = url($locr.'course/'.$slug);
        }
    } else {
        $troute = '#';
    }

    

    return $troute;
}

function renderBar($perc,$class=''){
    echo '<div class="bar '.$class.'" title="'.$perc.'%"><div style="width:'.$perc.'%"></div></div>';
}
function getPerc($partial,$total){
    if($partial != 0 && $total != 0){
        return round($partial*100/$total);
    } else {
        return 0;
    }
}

function getCourseSessionDate($course){
    $cAttr = session('date_'.$course->id);
    $cDate = $course->$cAttr;
    return $cDate;
}

function getCourseDates($course){
    $today = date('Y-m-d');
    $datesStr = $course->dates;
    $Cdates = explode(',', $datesStr);
    foreach($Cdates as $key => $dateElem){
        if($dateElem < $today){
            unset($Cdates[$key]);
        }
    }
    sort($Cdates);
    return $Cdates;
}
function getStudents($course,$date){
    return $course->users()->wherePivot('start_date',$date)->whereHas('roles', function (Builder $query)  {
        $query->where('roles.id', 'like', 2);
    })->get()->count();
}



function getTeacher($chat){
    return $chat->users()->whereHas('roles', function (Builder $query)  {
        $query->where('roles.id', 'like', 3);
    })->first();
}
function getStudent($chat){
    return $chat->users()->whereHas('roles', function (Builder $query)  {
        $query->where('roles.id', '!=', 3);
    })->first();
}
function getOtherPerson($chat){
    $user = Auth::user();

    return $chat->users()->where('id','!=',$user->id)->first();
}

function getCourseName($id){
    $c = App\Course::find($id);
    return $c->title;
}

function getTeacherUser($id){
    $teacher = App\Teacher::find($id);
    $user = App\User::find($teacher->user_id);
    return $user;
}
function getUserTeacher($user){
    $teacher = App\Teacher::where('user_id',$user->id)->first();
    return $teacher;
}

function getAssignment($user,$lesson){
    $assignment = App\LessonUserMedia::where('user_id',$user)->where('lesson_id',$lesson)->first();
    return $assignment;
}

function getUserLessons($user,$moduleId){
    return $user->lessons()->where('module_id',$moduleId)->get()->count();
}

function assignmentSent($userId, $assignmentId){
    $assignment = App\LessonUserMedia::where('user_id',$userId)->where('assignment_id',$assignmentId)->first();
    return $assignment;
}

function getDistributorCodes($distributor){
    $codes = App\Code::where('distributor_id',$distributor->id)->get();
    return $codes->count();
}
function getDistributor($id){
    $dist = App\Distributor::find($id);
    return $dist->name;
}
function getRedeemed($code){
    $orders = App\Order::where('code',$code->code)->get();
    return $orders->count();
}

function getTeacherByID($id){
    $teach = App\Teacher::find($id);
    return $teach->title;
}

function getAssignedTeacherID($student,$course){
    $course = $student->courses()->where('courses.id',$course->id)->orderBy('created_at','desc')->first();
    return $course->pivot->teacher_id;
}
function getAssignedTeacherUser($student,$course){
    $course = $student->courses()->where('courses.id',$course->id)->orderBy('created_at','desc')->first();
    $teacher =  App\Teacher::find($course->pivot->teacher_id);
    $user = App\User::find($teacher->user_id);
    return $user;
}
function daysToMonths($days){
    return floor($days/30);
}

function getUserCourses($user){
    $courses = '';
    foreach($user->courses()->get() as $c){
        $teach = App\Teacher::find($c->pivot->teacher_id);
        $courses .= $c->title.' ('.$teach->title.')<br>';
    }
    return $courses;
}

function getTeacherStudents($teacher){
    //$courses = App\Course::where('published',1)->get();
    $user = getTeacherUser($teacher->id);
    $courses = $user->courses()->get();
    $total = '';
    if($courses->count() > 0){
        foreach($courses as $c){
            $total .= $c->title.' - '.$c->users()->wherePivot('teacher_id',$teacher->id)->count().'<br>';
        }
    }
    return $total;
}

function getSchoolByID($id){
    if($id != 0){
        $schl = App\School::find($id);
        return '<span class="school_tag school_'.$schl->id.'">'.$schl->title.'</span>';
    } else {
        return '<span class="school_tag school_gen">ICCIC</span>';
    }
}