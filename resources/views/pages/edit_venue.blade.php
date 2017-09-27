<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?= asset('lib/html5shiv.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('lib/respond.min.js') ?>"></script>

    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?= asset('static/h-ui/css/H-ui.min.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= asset('static/h-ui.admin/css/H-ui.admin.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= asset('lib/Hui-iconfont/1.0.8/iconfont.css') ?>"/>

    <link rel="stylesheet" type="text/css" href="<?= asset('static/h-ui.admin/skin/default/skin.css') ?>" id="skin"/>
    <link rel="stylesheet" type="text/css" href="<?= asset('static/h-ui.admin/css/style.css') ?>"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="<?= asset('lib/DD_belatedPNG_0.0.8a-min.js') ?>"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <link href="<?= asset('lib/webuploader/0.1.5/webuploader.css') ?>" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="page-container">
    <form action="{{url('/venue')}}/{{$key}}" method="post" class="form form-horizontal" id="form-venue-add">
        {!! csrf_field() !!}
        <input type="hidden" name="key" value="{{$venue['id']}}">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Confirm：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="check-box">
                    @if(!empty($venue['confirm']) && $venue['confirm'] == true)
                        <input type="checkbox" id="venue_confirm" name="confirm" checked>
                    @else
                        <input type="checkbox" id="venue_confirm" name="confirm">
                    @endif
                    <label for="checkbox-1">&nbsp;</label>
                </div>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>Name：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if(empty($venue['name']))
                    <input type="text" class="input-text" value="" placeholder="" id="venue_name" name="name">
                @else
                    <input type="text" class="input-text" placeholder="" id="venue_name" name="name"
                           value="{{$venue['name']}}">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Type：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="type" id="venue_type" class="select">
                    @if(empty($venue['type']))
                        <option value="marijuana">Marijuana</option>
                        <option value="cigar">Cigar</option>
                    @else
                        @if($venue['type'] == 'marijuana')
                            <option value="marijuana" selected>Marijuana</option>
                            <option value="cigar">Cigar</option>
                        @else
                            <option value="marijuana">Marijuana</option>
                            <option value="cigar" selected>Cigar</option>
                        @endif
                    @endif
				</select>
				</span></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Description：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if(empty($venue['name']))
                    <input type="text" class="input-text" value="" placeholder="" id="venue_description"
                           name="description">
                @else
                    <input type="text" class="input-text" value="{{$venue['name']}}" placeholder=""
                           id="venue_description" name="description">
                @endif
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>Address：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if(empty($venue['address']))
                    <input type="text" class="input-text" value="" placeholder="" id="venue_address" name="address">
                @else
                    <input type="text" class="input-text" value="{{$venue['address']}}" placeholder=""
                           id="venue_address" name="address">
                @endif

                @if(empty($venue['latitude']))
                    <input type="hidden" name="lat" id="venue_lat">
                @else
                    <input type="hidden" name="lat" id="venue_lat" value="{{$venue['latitude']}}">
                @endif

                @if(empty($venue['longitude']))
                    <input type="hidden" name="lng" id="venue_lng">
                @else
                    <input type="hidden" name="lng" id="venue_lng" value="{{$venue['longitude']}}">
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Outdoor：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="check-box">
                    @if(!empty($venue['outdoor']) && $venue['outdoor'] == true)
                        <input type="checkbox" id="venue_outdoor" name="outdoor" checked>
                    @else
                        <input type="checkbox" id="venue_outdoor" name="outdoor">
                    @endif
                    <label for="checkbox-1">&nbsp;</label>

                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Public：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="check-box">
                    @if(!empty($venue['isPrivate']) && $venue['isPrivate'] == true)
                        <input type="checkbox" id="venue_public" name="public">
                    @else
                        <input type="checkbox" id="venue_public" name="public" checked>
                    @endif
                    <label for="checkbox-1">&nbsp;</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Wifi：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="check-box">
                    @if(!empty($venue['wifi']) && $venue['wifi'] == true)
                        <input type="checkbox" id="venue_wifi" name="wifi" checked>
                    @else
                        <input type="checkbox" id="venue_wifi" name="wifi">
                    @endif
                    <label for="checkbox-1">&nbsp;</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Number of seats：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                    <?php
                    $seats = ['1-10', '10-50', '50-100', '100-500', '500-'];
                    ?>
                    <select name="num_of_seats" class="select">
                    @foreach($seats as $s)
                            @if(!empty($venue['num_of_seats']) && $s == $venue['num_of_seats'])
                                <option value="{{$s}}" selected>{{$s}}</option>
                            @else
                                <option value="{{$s}}">{{$s}}</option>
                            @endif
                        @endforeach
				</select>
				</span></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Open Hours：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <?php
                $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                $hours = ["---", "00:00", "00:30",
                        "01:00", "01:30",
                        "02:00", "02:30",
                        "03:00", "03:30",
                        "04:00", "04:30",
                        "05:00", "05:30",
                        "06:00", "06:30",
                        "07:00", "07:30",
                        "08:00", "08:30",
                        "09:00", "09:30",
                        "10:00", "10:30",
                        "11:00", "11:30",
                        "12:00", "12:30",
                        "13:00", "13:30",
                        "14:00", "14:30",
                        "15:00", "15:30",
                        "16:00", "16:30",
                        "17:00", "17:30",
                        "18:00", "18:30",
                        "19:00", "19:30",
                        "20:00", "20:30",
                        "21:00", "21:30",
                        "22:00", "22:30",
                        "23:00", "23:30"];
                ?>
                @foreach($weekdays as $w)
                    <div class="row cl">
                        <div class="formControls col-xs-2 col-sm-2">
                            {{$w}}:
                        </div>
                        <div class="formControls col-xs-4 col-sm-4">
                            <select name="{{$w}}_open" class="select" style="width:100px">
                                @foreach($hours as $h)
                                    @if(!empty($venue['open_hours']) && !empty($venue['open_hours'][strtolower($w)]) &&
                                    $venue['open_hours'][strtolower($w)] == $h)
                                        <option value="{{$h}}" selected>{{$h}}</option>
                                    @else
                                        <option value="{{$h}}">{{$h}}</option>
                                    @endif
                                @endforeach
                            </select> &nbsp;
                            To
                            <select name="{{$w}}_close" class="select" style="width:100px">
                                @foreach($hours as $h)
                                    @if(!empty($venue['close_hours']) && !empty($venue['close_hours'][strtolower($w)]) &&
                                    $venue['close_hours'][strtolower($w)] == $h)
                                        <option value="{{$h}}" selected>{{$h}}</option>
                                    @else
                                        <option value="{{$h}}">{{$h}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Phone：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if(empty($venue['phone']))
                <input type="text" name="phone" id="venue_phone" placeholder="" value="" class="input-text"
                       style="width:90%">
                @else
                    <input type="text" name="phone" id="venue_phone" placeholder="" value="{{$venue['phone']}}" class="input-text"
                           style="width:90%">
                    @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Airbnb：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if(empty($venue['airbnb']))
                <input type="text" name="airbnb" id="venue_airbnb" placeholder="" value="" class="input-text"
                       style="width:90%">
                    @else
                    <input type="text" name="airbnb" id="venue_airbnb" placeholder="" value="{{$venue['airbnb']}}" class="input-text"
                           style="width:90%">
                    @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Weblink：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if(empty($venue['weblink']))
                <input type="text" name="weblink" id="venue_weblink" placeholder="" value="" class="input-text"
                       style="width:90%">
                    @else
                    <input type="text" name="weblink" id="venue_weblink" placeholder="" value="{{$venue['weblink']}}" class="input-text"
                           style="width:90%">
                @endif
            </div>
        </div>

        {{--<div class="row cl">--}}
            {{--<label class="form-label col-xs-4 col-sm-2">Thumbnails：</label>--}}
            {{--<div class="formControls col-xs-8 col-sm-9">--}}
                {{--<div class="uploader-thum-container">--}}
                    {{--<div id="fileList" class="uploader-list"></div>--}}
                    {{--<div id="filePicker">Choose</div>--}}
                    {{--<button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">Start Upload</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">Photo Upload：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-list-container">
                    <div class="queueList">
                        <div id="dndArea" class="placeholder">
                            <div id="filePicker-2"></div>
                            <p>Upload venue photos</p>
                        </div>
                    </div>
                    <div class="statusBar" style="display:none;">
                        <div class="progress"><span class="text">0%</span> <span class="percentage"></span></div>
                        <div class="info"></div>
                        <div class="btns">
                            <div id="filePicker2"></div>
                            <div class="uploadBtn">Upload</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i
                            class="Hui-iconfont">&#xe632;</i> Save
                </button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;Cancel&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="<?= asset('lib/jquery/1.9.1/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/layer/2.4/layer.js') ?>"></script>
<script type="text/javascript" src="<?= asset('static/h-ui/js/H-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('static/h-ui.admin/js/H-ui.admin.js') ?>"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?= asset('lib/My97DatePicker/4.8/WdatePicker.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/jquery.validation/1.14.0/jquery.validate.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/jquery.validation/1.14.0/validate-methods.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/jquery.validation/1.14.0/messages_zh.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/webuploader/0.1.5/webuploader.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/ueditor/1.4.3/ueditor.config.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/ueditor/1.4.3/ueditor.all.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js') ?>"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiMBFdkcUd7l5gLA-6EXnDrjtlBikTvfU&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
<script>
    // Initialize Firebase
    // TODO: Replace with your project's customized code snippet
    var config = {
        apiKey: "AIzaSyDSfkEQ3U5yK8bHXdPzPXeXxCjZCuGesTg",
        authDomain: "smokehere-e68ae.firebaseapp.com",
        databaseURL: "https://smokehere-e68ae.firebaseio.com",
        storageBucket: "smokehere-e68ae.appspot.com",
        messagingSenderId: "866527911437",
    };
    firebase.initializeApp(config);

    var storage = firebase.storage();

    // Create a storage reference from our storage service
    var storageRef = storage.ref();

</script>
<script type="text/javascript">
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
//        street_number: 'short_name',
//        route: 'long_name',
//        locality: 'long_name',
//        administrative_area_level_1: 'short_name',
        country: 'venue_description',
//        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('venue_address')),
                {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        console.log(place.geometry.location.lat(), place.geometry.location.lng());
        document.getElementById("venue_lat").value = place.geometry.location.lat();
        document.getElementById("venue_lng").value = place.geometry.location.lng();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script type="text/javascript">
    $(function () {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-venue-add").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 4,
                    maxlength: 500
                },
                address: {
                    required: true,
                },
            },
            onkeyup: false,
            focusCleanup: true,
            success: "valid",
            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    type: 'post',
                    url: "{{url('/venue')}}",
                    success: function (data) {
                        layer.msg('Successfully added!', {icon: 1, time: 1000});
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        layer.msg('error!', {icon: 1, time: 1000});
                    }
                });
                var index = parent.layer.getFrameIndex(window.name);
                parent.$('.btn-refresh').click();
                parent.layer.close(index);
            }
        });

        $list = $("#fileList"),
                $btn = $("#btn-star"),
                state = "pending",
                uploader;

        var uploader = WebUploader.create({
            auto: true,
            swf: '<?= asset("lib/webuploader/0.1.5/Uploader.swf")?>',

            // 文件接收服务端。
            server: '<?= asset("lib/webuploader/0.1.5/server/fileupload.php") ?>',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on('fileQueued', function (file) {
            console.log("filequeued");
            var $li = $(
                            '<div id="' + file.id + '" class="item">' +
                            '<div class="pic-box"><img></div>' +
                            '<div class="info">' + file.name + '</div>' +
                            '<p class="state">等待上传...</p>' +
                            '</div>'
                    ),
                    $img = $li.find('img');
            $list.append($li);

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr('src', src);
            }, thumbnailWidth, thumbnailHeight);
        });
        // 文件上传过程中创建进度条实时显示。
        uploader.on('uploadProgress', function (file, percentage) {
            console.log('uploadProgress');
            var $li = $('#' + file.id),
                    $percent = $li.find('.progress-box .sr-only');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo($li).find('.sr-only');
            }
            $li.find(".state").text("上传中");
            $percent.css('width', percentage * 100 + '%');
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on('uploadSuccess', function (file) {
            console.log('uploadSuccess');
            $('#' + file.id).addClass('upload-state-success').find(".state").text("已上传");
        });

        // 文件上传失败，显示上传出错。
        uploader.on('uploadError', function (file) {
            console.log('***upload Error');
            $('#' + file.id).addClass('upload-state-error').find(".state").text("Upload error");
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on('uploadComplete', function (file) {
            console.log('***uploadcomplete');
            $('#' + file.id).find('.progress-box').fadeOut();
        });
        uploader.on('all', function (type) {
            console.log('***uploader all type:', type);
            if (type === 'startUpload') {
                state = 'uploading';
            } else if (type === 'stopUpload') {
                state = 'paused';
            } else if (type === 'uploadFinished') {
                state = 'done';
            }
            console.log('uploader status:', status);

            if (state === 'uploading') {
                $btn.text('Stop');
            } else {
                $btn.text('Start');
            }
        });

        $btn.on('click', function () {
            console.log('btn click, status:', status);
            if (state === 'uploading') {
                uploader.stop();
            } else {
                uploader.upload();
            }
        });

    });

    (function ($) {
        // 当domReady的时候开始初始化
        $(function () {
            var $wrap = $('.uploader-list-container'),

                    // 图片容器
                    $queue = $('<ul class="filelist"></ul>')
                            .appendTo($wrap.find('.queueList')),

                    // 状态栏，包括进度和控制按钮
                    $statusBar = $wrap.find('.statusBar'),

                    // 文件总体选择信息。
                    $info = $statusBar.find('.info'),

                    // 上传按钮
                    $upload = $wrap.find('.uploadBtn'),

                    // 没选择文件之前的内容。
                    $placeHolder = $wrap.find('.placeholder'),

                    $progress = $statusBar.find('.progress').hide(),

                    // 添加的文件数量
                    fileCount = 0,

                    // 添加的文件总大小
                    fileSize = 0,

                    // 优化retina, 在retina下这个值是2
                    ratio = window.devicePixelRatio || 1,

                    // 缩略图大小
                    thumbnailWidth = 110 * ratio,
                    thumbnailHeight = 110 * ratio,

                    // 可能有pedding, ready, uploading, confirm, done.
                    state = 'pedding',

                    // 所有文件的进度信息，key为file id
                    percentages = {},
                    // 判断浏览器是否支持图片的base64
                    isSupportBase64 = (function () {
                        var data = new Image();
                        var support = true;
                        data.onload = data.onerror = function () {
                            if (this.width != 1 || this.height != 1) {
                                support = false;
                            }
                        }
                        data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                        return support;
                    })(),

                    // 检测是否已经安装flash，检测flash的版本
                    flashVersion = (function () {
                        var version;

                        try {
                            version = navigator.plugins['Shockwave Flash'];
                            version = version.description;
                        } catch (ex) {
                            try {
                                version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
                                        .GetVariable('$version');
                            } catch (ex2) {
                                version = '0.0';
                            }
                        }
                        version = version.match(/\d+/g);
                        return parseFloat(version[0] + '.' + version[1], 10);
                    })(),

                    supportTransition = (function () {
                        var s = document.createElement('p').style,
                                r = 'transition' in s ||
                                        'WebkitTransition' in s ||
                                        'MozTransition' in s ||
                                        'msTransition' in s ||
                                        'OTransition' in s;
                        s = null;
                        return r;
                    })(),

                    // WebUploader实例
                    uploader;

            if (!WebUploader.Uploader.support('flash') && WebUploader.browser.ie) {

                // flash 安装了但是版本过低。
                if (flashVersion) {
                    (function (container) {
                        window['expressinstallcallback'] = function (state) {
                            switch (state) {
                                case 'Download.Cancelled':
                                    alert('You canceled the update！')
                                    break;

                                case 'Download.Failed':
                                    alert('Download failed')
                                    break;

                                default:
                                    alert('Installation has been successful, please refresh!');
                                    break;
                            }
                            delete window['expressinstallcallback'];
                        };

                        var swf = 'expressInstall.swf';
                        // insert flash object
                        var html = '<object type="application/' +
                                'x-shockwave-flash" data="' + swf + '" ';

                        if (WebUploader.browser.ie) {
                            html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
                        }

                        html += 'width="100%" height="100%" style="outline:0">' +
                                '<param name="movie" value="' + swf + '" />' +
                                '<param name="wmode" value="transparent" />' +
                                '<param name="allowscriptaccess" value="always" />' +
                                '</object>';

                        container.html(html);

                    })($wrap);

                    // 压根就没有安转。
                } else {
                    $wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
                }

                return;
            } else if (!WebUploader.Uploader.support()) {
                alert('Web Uploader does not support your browser！');
                return;
            }

            // 实例化
            uploader = WebUploader.create({
                pick: {
                    id: '#filePicker-2',
                    label: 'Choose files'
                },
                formData: {
                    uid: 123
                },
                dnd: '#dndArea',
                paste: '#uploader',
                swf: '<?= asset("lib/webuploader/0.1.5/Uploader.swf") ?>',
                chunked: false,
                chunkSize: 512 * 1024,
                server: '<?= asset("lib/webuploader/0.1.5/server/fileupload.php") ?>',
                // runtimeOrder: 'flash',

                // accept: {
                //     title: 'Images',
                //     extensions: 'gif,jpg,jpeg,bmp,png',
                //     mimeTypes: 'image/*'
                // },

                // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
                disableGlobalDnd: true,
                fileNumLimit: 300,
                fileSizeLimit: 200 * 1024 * 1024,    // 200 M
                fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
            });

            // 拖拽时不接受 js, txt 文件。
            uploader.on('dndAccept', function (items) {
                console.log('***uploader dndAccept', items);
                var denied = false,
                        len = items.length,
                        i = 0,
                        // 修改js类型
                        unAllowed = 'text/plain;application/javascript ';

                for (; i < len; i++) {
                    // 如果在列表里面
                    if (~unAllowed.indexOf(items[i].type)) {
                        denied = true;
                        break;
                    }
                }

                return !denied;
            });

            uploader.on('dialogOpen', function () {
                console.log('***uploader dialogOpen');
            });

            // uploader.on('filesQueued', function() {
            //     uploader.sort(function( a, b ) {
            //         if ( a.name < b.name )
            //           return -1;
            //         if ( a.name > b.name )
            //           return 1;
            //         return 0;
            //     });
            // });

            // 添加“添加文件”的按钮，
            uploader.addButton({
                id: '#filePicker2',
                label: '继续添加'
            });

            uploader.on('ready', function () {
                console.log('***uploader.ready');
                window.uploader = uploader;
            });

            // 当有文件添加进来时执行，负责view的创建
            function addFile(file) {
                console.log('addFile :', file);
                var $li = $('<li id="' + file.id + '">' +
                                '<p class="title">' + file.name + '</p>' +
                                '<p class="imgWrap"></p>' +
                                '<p class="progress"><span></span></p>' +
                                '</li>'),

                        $btns = $('<div class="file-panel">' +
                                '<span class="cancel">Delete</span>' +
                                '<span class="rotateRight">Rotate right</span>' +
                                '<span class="rotateLeft">Rotate left</span></div>').appendTo($li),
                        $prgress = $li.find('p.progress span'),
                        $wrap = $li.find('p.imgWrap'),
                        $info = $('<p class="error"></p>'),

                        showError = function (code) {
                            switch (code) {
                                case 'exceed_size':
                                    text = 'File size is large';
                                    break;

                                case 'interrupt':
                                    text = 'Upload canceled';
                                    break;

                                default:
                                    text = 'Upload failed, try again';
                                    break;
                            }

                            $info.text(text).appendTo($li);
                        };

                if (file.getStatus() === 'invalid') {
                    showError(file.statusText);
                } else {
                    // @todo lazyload
                    $wrap.text('In preview');
                    uploader.makeThumb(file, function (error, src) {
                        var img;

                        if (error) {
                            $wrap.text('Can not preview');
                            return;
                        }

                        if (isSupportBase64) {
                            img = $('<img src="' + src + '">');
                            $wrap.empty().append(img);
                        } else {
                            $.ajax('<?= asset("lib/webuploader/0.1.5/server/preview.php") ?>', {
                                method: 'POST',
                                data: src,
                                dataType: 'json'
                            }).done(function (response) {
                                if (response.result) {
                                    img = $('<img src="' + response.result + '">');
                                    $wrap.empty().append(img);
                                } else {
                                    $wrap.text("Preview error");
                                }
                            });
                        }
                    }, thumbnailWidth, thumbnailHeight);

                    percentages[file.id] = [file.size, 0];
                    file.rotation = 0;
                }

                file.on('statuschange', function (cur, prev) {
                    if (prev === 'progress') {
                        $prgress.hide().width(0);
                    } else if (prev === 'queued') {
                        $li.off('mouseenter mouseleave');
                        $btns.remove();
                    }

                    // 成功
                    if (cur === 'error' || cur === 'invalid') {
                        console.log(file.statusText);
                        showError(file.statusText);
                        percentages[file.id][1] = 1;
                    } else if (cur === 'interrupt') {
                        showError('interrupt');
                    } else if (cur === 'queued') {
                        percentages[file.id][1] = 0;
                    } else if (cur === 'progress') {
                        $info.remove();
                        $prgress.css('display', 'block');
                    } else if (cur === 'complete') {
                        $li.append('<span class="success"></span>');
                    }

                    $li.removeClass('state-' + prev).addClass('state-' + cur);
                });

                $li.on('mouseenter', function () {
                    $btns.stop().animate({height: 30});
                });

                $li.on('mouseleave', function () {
                    $btns.stop().animate({height: 0});
                });

                $btns.on('click', 'span', function () {
                    var index = $(this).index(),
                            deg;

                    switch (index) {
                        case 0:
                            uploader.removeFile(file);
                            return;

                        case 1:
                            file.rotation += 90;
                            break;

                        case 2:
                            file.rotation -= 90;
                            break;
                    }

                    if (supportTransition) {
                        deg = 'rotate(' + file.rotation + 'deg)';
                        $wrap.css({
                            '-webkit-transform': deg,
                            '-mos-transform': deg,
                            '-o-transform': deg,
                            'transform': deg
                        });
                    } else {
                        $wrap.css('filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (~~((file.rotation / 90) % 4 + 4) % 4) + ')');
                        // use jquery animate to rotation
                        // $({
                        //     rotation: rotation
                        // }).animate({
                        //     rotation: file.rotation
                        // }, {
                        //     easing: 'linear',
                        //     step: function( now ) {
                        //         now = now * Math.PI / 180;

                        //         var cos = Math.cos( now ),
                        //             sin = Math.sin( now );

                        //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                        //     }
                        // });
                    }


                });

                $li.appendTo($queue);
            }

            // 负责view的销毁
            function removeFile(file) {
                console.log('removeFile:', file);
                var $li = $('#' + file.id);

                delete percentages[file.id];
                updateTotalProgress();
                $li.off().find('.file-panel').off().end().remove();
            }

            function updateTotalProgress() {
                var loaded = 0,
                        total = 0,
                        spans = $progress.children(),
                        percent;

                $.each(percentages, function (k, v) {
                    total += v[0];
                    loaded += v[0] * v[1];
                });

                percent = total ? loaded / total : 0;


                spans.eq(0).text(Math.round(percent * 100) + '%');
                spans.eq(1).css('width', Math.round(percent * 100) + '%');
                updateStatus();
            }

            function updateStatus() {
                console.log('updateStatus');
                var text = '', stats;

                if (state === 'ready') {
                    text = '' + fileCount + ' files，total' +
                            WebUploader.formatSize(fileSize) + '.';
                } else if (state === 'confirm') {
                    stats = uploader.getStats();
                    if (stats.uploadFailNum) {
                        text = 'uploaded' + stats.successNum + 'files，' +
                                stats.uploadFailNum + 'failed，<a class="retry" href="#">Retry</a> or <a class="ignore" href="#">Ignore</a>'
                    }

                } else {
                    stats = uploader.getStats();
                    text = '' + fileCount + ' files（' +
                            WebUploader.formatSize(fileSize) +
                            '），uploaded' + stats.successNum + 'files';

                    if (stats.uploadFailNum) {
                        text += '，failed' + stats.uploadFailNum + 'files';
                    }
                }

                $info.html(text);
            }

            function setState(val) {
                console.log('setState:', val);
                var file, stats;

                if (val === state) {
                    return;
                }

                $upload.removeClass('state-' + state);
                $upload.addClass('state-' + val);
                state = val;

                switch (state) {
                    case 'pedding':
                        $placeHolder.removeClass('element-invisible');
                        $queue.hide();
                        $statusBar.addClass('element-invisible');
                        uploader.refresh();
                        break;

                    case 'ready':
                        $placeHolder.addClass('element-invisible');
                        $('#filePicker2').removeClass('element-invisible');
                        $queue.show();
                        $statusBar.removeClass('element-invisible');
                        uploader.refresh();
                        break;

                    case 'uploading':
                        $('#filePicker2').addClass('element-invisible');
                        $progress.show();
                        $upload.text('暂停上传');
                        break;

                    case 'paused':
                        $progress.show();
                        $upload.text('继续上传');
                        break;

                    case 'confirm':
                        $progress.hide();
                        $('#filePicker2').removeClass('element-invisible');
                        $upload.text('开始上传');

                        stats = uploader.getStats();
                        if (stats.successNum && !stats.uploadFailNum) {
                            setState('finish');
                            return;
                        }
                        break;
                    case 'finish':
                        stats = uploader.getStats();
                        if (stats.successNum) {
                            alert('上传成功');
                        } else {
                            // 没有成功的图片，重设
                            state = 'done';
                            location.reload();
                        }
                        break;
                }

                updateStatus();
            }

            uploader.onUploadProgress = function (file, percentage) {
                var $li = $('#' + file.id),
                        $percent = $li.find('.progress span');

                $percent.css('width', percentage * 100 + '%');
                percentages[file.id][1] = percentage;
                updateTotalProgress();
            };

            uploader.onFileQueued = function (file) {
                fileCount++;
                fileSize += file.size;

                if (fileCount === 1) {
                    $placeHolder.addClass('element-invisible');
                    $statusBar.show();
                }

                addFile(file);
                setState('ready');
                updateTotalProgress();
            };

            uploader.onFileDequeued = function (file) {
                fileCount--;
                fileSize -= file.size;

                if (!fileCount) {
                    setState('pedding');
                }

                removeFile(file);
                updateTotalProgress();

            };

            uploader.on('all', function (type) {
                var stats;
                switch (type) {
                    case 'uploadFinished':
                        setState('confirm');
                        break;

                    case 'startUpload':
                        setState('uploading');
                        break;

                    case 'stopUpload':
                        setState('paused');
                        break;

                }
            });

            uploader.onError = function (code) {
                alert('Eroor: ' + code);
            };

            $upload.on('click', function () {
                console.log('upload.click');
                if ($(this).hasClass('disabled')) {
                    return false;
                }

                if (state === 'ready') {
                    console.log('here to upload:');
                    uploader.upload();
                } else if (state === 'paused') {
                    uploader.upload();
                } else if (state === 'uploading') {
                    uploader.stop();
                }
            });

            $info.on('click', '.retry', function () {
                uploader.retry();
            });

            $info.on('click', '.ignore', function () {
                alert('todo');
            });

            $upload.addClass('state-' + state);
            updateTotalProgress();
        });

    })(jQuery);

    $(function () {
        var ue = UE.getEditor('editor');
    });
</script>
</body>
</html>