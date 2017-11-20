<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="favicon.ico">
    <link rel="Shortcut Icon" href="favicon.ico"/>
    <!--[if lt IE 9]>

    <script type="text/javascript" src="<?= asset('lib/html5.js') ?>"></script>
    <script type="text/javascript" src="<?= asset('lib/respond.min.js') ?>"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?= asset('static/h-ui/css/H-ui.min.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= asset('static/h-ui.admin/css/H-ui.admin.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= asset('lib/Hui-iconfont/1.0.8/iconfont.css') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= asset('static/h-ui.admin/skin/default/skin.css') ?>" id="skin"/>
    <link rel="stylesheet" type="text/css" href="<?= asset('static/h-ui.admin/css/style.css') ?>"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script><![endif]-->

    <title>Venues</title>
    <meta name="keywords" content="register, venues, marijuana, cigar">
    <meta name="description" content="">
</head>
<body>

<!--_header-->
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl">
            <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">Smoke Here Dashboard</a>
            <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">Smoke Here</a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs">v1.0</span>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>

            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>Administrator</li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!--/_header 作为公共模版分离出去-->

<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">

    <div class="menu_dropdown bk_2">
        <dl id="menu-article">
            <dt class="selected"><i class="Hui-iconfont">&#xe616;</i> Venues Dashboard<i
                        class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd style="display:block">
                <ul>
                    <li class="current">
                        <a href="#" title="Venues"> View Venues</a>
                    </li>

                </ul>
            </dd>
        </dl>

        <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> Admin Settings<i class="Hui-iconfont menu_dropdown-arrow">
                    &#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a href="#" title="角色管理">Change Password</a>
                    </li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<div class="dislpayArrow hidden-xs">
    <a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
</div>
<!--/_menu 作为公共模版分离出去-->

<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> Dashboard
        <span class="c-gray en">&gt;</span>
        Venues

        <a class="btn btn-success btn-refresh radius r" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="Refresh"><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <div class="Hui-article">
        <article class="cl pd-20">
            <div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
                    <a class="btn btn-primary radius" data-title="Add" _href="{{url('/venues/add')}}"
                       onclick="venue_add('Add Venue','{{url("/venues/add")}}')" href="javascript:;"><i
                                class="Hui-iconfont Hui-iconfont-add"></i> Add</a>

				</span>
                <span class="r">
                    Results：<strong>{{count($venues)}}</strong>&emsp;
                    <a class="btn btn-primary radius" data-title="Export as Excel" href="{{url('/venues/export/csv')}}"><i
                                class="Hui-iconfont Hui-iconfont-down"></i> Export</a>
                </span>
            </div>
            <h3>Verified Venues & Uploaded Venues Awaiting Verification</h3>
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th width="25"><input type="checkbox" name="" value=""></th>
                        <th width="120">Name</th>
                        <th width="80">Type</th>
                        <th width="120">Address</th>
                        <th width="200">Description</th>
                        <th width="75">Phone</th>
                        <th width="200">Weblink</th>
                        <th width="30">Verify</th>
                        <th width="60">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($venues as $v)
                        {{--@if(!empty($v['confirm']) && $v['confirm'] == true)--}}
                        <tr class="text-c">
                            <td><input type="checkbox" value="" name=""></td>
                            <td class="text-l"><u style="cursor:pointer" class="text-primary"
                                                  onClick="venue_edit('Edit Venue','{{url("/venues/")}}/{{$v["id"]}}','{{$v["id"]}}')"
                                                  title="Edit">{{$v["name"]}}</u></td>
                            <td>
                                @if(empty($v['estateType']))
                                    Club
                                @else
                                    @if($v['estateType'] == 'smokingVenue')
                                        Club
                                    @else
                                        Lodging
                                    @endif
                                @endif
                            </td>
                            <td>{{$v["address"]}}</td>
                            <td>{{str_limit($v["description"], $limit = 150, $end = '...')}}</td>
                            <td>{{$v["phone"]}}</td>
                            <td>
                                @if ( parse_url($v["weblink"]) )
                                    <a href="{{$v["weblink"]}}" target="_blank">{{$v["weblink"]}}</a>
                                @endif
                            </td>
                            <td class="td-status">
                                @if(!empty($v['confirm']) && $v['confirm'] == true)
                                    <span class="label label-success radius">verified</span>
                                @endif
                            </td>
                            <td class="f-14 td-manage">
                                @if(empty($v['confirm']) || $v['confirm'] == false)
                                    <a style="text-decoration:none" onClick="venue_confirm(this,'{{$v["id"]}}')"
                                       href="javascript:;" title="Verify"><i
                                                class="Hui-iconfont Hui-iconfont-xiajia"></i></a>
                                @endif
                                <a style="text-decoration:none" class="ml-5"
                                   onClick="venue_edit('Edit Venue','{{url("/venues")}}/{{$v["id"]}}','{{$v["id"]}}')"
                                   href="javascript:;" title="Edit Venue"><i
                                            class="Hui-iconfont Hui-iconfont-edit"></i></a>
                                <a style="text-decoration:none" class="ml-5" onClick="venue_del(this,'{{$v["id"]}}')"
                                   href="javascript:;" title="Delete"><i class="Hui-iconfont Hui-iconfont-del3"></i></a>
                            </td>
                        </tr>
                        {{--@endif--}}
                    @empty
                        <tr class="text-c">
                            <td colspan="11">No venues</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <br><br>
            <!-- unverified venues table -->
            <h3>Pending Venues</h3>
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th width="25"><input type="checkbox" name="" value=""></th>
                        <th width="120">Name</th>
                        <th width="80">Type</th>
                        <th width="120">Address</th>
                        <th width="200">Description</th>
                        <th width="75">Phone</th>
                        <th width="200">Weblink</th>
                        <th width="200">Contact Info</th>
                        <th width="50">UL Time</th>
                        <th width="30">Verify</th>
                        <th width="60">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($venues as $v)
                        @if(empty($v['confirm']) || $v['confirm'] == false)
                            <tr class="text-c">
                                <td><input type="checkbox" value="" name=""></td>
                                <td class="text-l"><u style="cursor:pointer" class="text-primary"
                                                      onClick="venue_edit('Edit Venue','{{url("/venues/")}}/{{$v["id"]}}','{{$v["id"]}}')"
                                                      title="Edit">{{$v["name"]}}</u></td>
                                <td>
                                    @if(empty($v['estateType']))
                                        Club
                                    @else
                                        @if($v['estateType'] == 'smokingVenue')
                                            Club
                                        @else
                                            Lodging
                                        @endif
                                    @endif
                                </td>
                                <td>{{$v["address"]}}</td>
                                <td>{{str_limit($v["description"], $limit = 150, $end = '...')}}</td>
                                <td>{{$v["phone"]}}</td>
                                <td>
                                    @if ( parse_url($v["weblink"]) )
                                        <a href="{{$v["weblink"]}}" target="_blank">{{$v["weblink"]}}</a>
                                    @endif
                                </td>
                                <td class="">
                                    @if(!empty($v['contact_info']))
                                        @if(!empty($v['contact_info']['contact_name']))
                                            Name: {{ $v['contact_info']['contact_name'] }}
                                            <br>
                                        @endif
                                        @if(!empty($v['contact_info']['contact_title']))
                                            Title: {{ $v['contact_info']['contact_title'] }}
                                            <br>
                                        @endif
                                        @if(!empty($v['contact_info']['contact_email']))
                                            Email: {{ $v['contact_info']['contact_email'] }}
                                            <br>
                                        @endif
                                        @if(!empty($v['contact_info']['contact_phone']))
                                            Phone: {{ $v['contact_info']['contact_phone'] }}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($v['time']))
                                        {{date('Y-m-d H:i:s',$v["time"])}}
                                    @endif
                                </td>
                                <td class="td-status">
                                    @if(!empty($v['confirm']) && $v['confirm'] == true)
                                        <span class="label label-success radius">verified</span>
                                    @endif
                                </td>
                                <td class="f-14 td-manage">
                                    @if(empty($v['confirm']) || $v['confirm'] == false)
                                        <a style="text-decoration:none" onClick="venue_confirm(this,'{{$v["id"]}}')"
                                           href="javascript:;" title="Verify"><i
                                                    class="Hui-iconfont Hui-iconfont-xiajia"></i></a>
                                    @endif
                                    <a style="text-decoration:none" class="ml-5"
                                       onClick="venue_edit('Edit Venue','{{url("/venues")}}/{{$v["id"]}}','{{$v["id"]}}')"
                                       href="javascript:;" title="Edit Venue"><i
                                                class="Hui-iconfont Hui-iconfont-edit"></i></a>
                                    <a style="text-decoration:none" class="ml-5"
                                       onClick="venue_del(this,'{{$v["id"]}}')"
                                       href="javascript:;" title="Delete"><i class="Hui-iconfont Hui-iconfont-del3"></i></a>
                                </td>

                            </tr>
                        @endif
                    @empty
                        <tr class="text-c">
                            <td colspan="11">No venues</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </article>
    </div>
</section>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="<?= asset('lib/jquery/1.9.1/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/layer/2.4/layer.js') ?>"></script>
<script type="text/javascript" src="<?= asset('static/h-ui/js/H-ui.js') ?>"></script>
<script type="text/javascript" src="<?= asset('static/h-ui.admin/js/H-ui.admin.page.js') ?>"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?= asset('lib/My97DatePicker/4.8/WdatePicker.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/datatables/1.10.0/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= asset('lib/laypage/1.2/laypage.js') ?>"></script>
<script type="text/javascript">
    $('.table-sort').dataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
//        "aoColumnDefs": [
//            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//            {"orderable": false, "aTargets": [0, 8]}// 不参与排序的列
//        ]
    });

    /*资讯-添加*/
    function venue_add(title, url, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*资讯-编辑*/
    function venue_edit(title, url, id, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*资讯-删除*/
    function venue_del(obj, id) {
        layer.confirm('Are you sure to delete？', function (index) {
            $.ajax({
                type: 'DELETE',
                url: '{{url('/venues')}}/' + id,
                dataType: 'json',
                data: {
                    "_token": '{{ csrf_token() }}'
                },
                success: function (data) {
                    $(obj).parents("tr").remove();
                    layer.msg('Deleted!', {icon: 1, time: 1000});
                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        }, 'Ok', 'Cancel');
    }

    /*资讯-下架*/
    function venue_confirm(obj, id) {
        layer.confirm('Are you sure to confirm？', {
            btn: ['Yes', 'No'],
            shade: false,
            closeBtn: 0
        }, function () {
            //        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="venue_start(this,id)" href="javascript:;" title="Confirmation"><i class="Hui-iconfont">&#xe603;</i></a>');
            $.ajax({
                type: 'POST',
                url: '{{url('/venues/')}}/' + id + '/confirm',
                dataType: 'json',
                data: {
                    "_token": '{{ csrf_token() }}'
                },
                success: function (data) {
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">verified</span>');
                    $(obj).remove();
                    layer.msg('Confirmed!', {icon: 6, time: 1000});
                },
                error: function (data) {
                    console.log(data.msg);
                    layer.msg('Error:', {icon: 5, time: 1000});
                },
            });


        });
    }


</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>