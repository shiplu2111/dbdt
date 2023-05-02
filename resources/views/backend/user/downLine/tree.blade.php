@extends('backend.user.layouts.master')
@section('title')
    DBDT- My Downline Tree View
@endsection
@section('content')
    <style>
        /*----------------genealogy-scroll----------*/

        .genealogy-scroll::-webkit-scrollbar {
            width: 5px;
            height: 8px;
        }

        .genealogy-scroll::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #e4e4e4;
        }

        .genealogy-scroll::-webkit-scrollbar-thumb {
            background: #212121;
            border-radius: 10px;
            transition: 0.5s;
        }

        .genealogy-scroll::-webkit-scrollbar-thumb:hover {
            background: #d5b14c;
            transition: 0.5s;
        }


        /*----------------genealogy-tree----------*/
        .genealogy-body {
            white-space: nowrap;
            overflow-y: hidden;
            padding: 50px;
            min-height: 500px;
            padding-top: 10px;
            text-align: center;
        }

        .genealogy-tree {
            display: inline-block;
        }

        .genealogy-tree ul {
            padding-top: 20px;
            position: relative;
            padding-left: 0px;
            display: flex;
            justify-content: center;
        }

        .genealogy-tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 50px 50px 50px 50px;
        }

        .genealogy-tree li::before,
        .genealogy-tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #ccc;
            width: 50%;
            height: 18px;
        }

        .genealogy-tree li::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #ccc;
        }

        .genealogy-tree li:only-child::after,
        .genealogy-tree li:only-child::before {
            display: none;
        }

        .genealogy-tree li:only-child {
            padding-top: 0;
        }

        .genealogy-tree li:first-child::before,
        .genealogy-tree li:last-child::after {
            border: 0 none;
        }

        .genealogy-tree li:last-child::before {
            border-right: 2px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }

        .genealogy-tree li:first-child::after {
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        .genealogy-tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #ccc;
            width: 0;
            height: 20px;
        }

        .genealogy-tree li a {
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
        }

        .genealogy-tree li a:hover+ul li::after,
        .genealogy-tree li a:hover+ul li::before,
        .genealogy-tree li a:hover+ul::before,
        .genealogy-tree li a:hover+ul ul::before {
            border-color: #fbba00;
        }

        /*--------------memeber-card-design----------*/
        .member-view-box {
            padding: 0px 20px;
            text-align: center;
            border-radius: 4px;
            position: relative;
        }

        .member-image {
            width: 60px;
            position: relative;
        }

        .member-image img {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            background-color: #000;
            z-index: 1;
        }

    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Downline</h1>
                        {!! Session::has('msg') ? Session::get('msg') : '' !!}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item "><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">My Downline</li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="body genealogy-body genealogy-scroll">
                <div class="genealogy-tree">
                    <ul>
                        <li>
                            <a href="javascript:void(0);">
                                <div class="member-view-box">
                                    <div class="member-image">
                                        @if (Auth::user()->profile_photo_path)
                                            <img style="border-radius: 50%; height: 50px; width: 50px;"
                                                src="{{ URL::to('/') }}/{{ Auth::user()->profile_photo_path }}"
                                                alt="{{ Auth::user()->name }}">
                                        @else
                                            <img style="border-radius: 50%; height: 50px; width: 50px;"
                                                src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">

                                        @endif
                                        <div class="member-details">
                                            <h5>{{ Auth::user()->name }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="active">
                                @php
                                    $my_first_level_users = DB::table('users')
                                        ->where('sponcerid', Auth::user()->myrefferalcode)
                                        ->where('status', '1')
                                        ->get();

                                @endphp
                                @if ($my_first_level_users)
                                    @foreach ($my_first_level_users as $item)
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="member-view-box">
                                                    <div class="member-image">
                                                        @if ($item->profile_photo_path)
                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                src="{{ URL::to('/') }}/{{ $item->profile_photo_path }}">
                                                            <br> {{ $item->name }}
                                                            <br>{{ $item->email }}
                                                        @else
                                                            <div class="member-image" style="font-weight: bold;">
                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                <br> {{ $item->name }}
                                                                <br>{{ $item->email }}
                                                            </div>

                                                        @endif

                                                    </div>
                                                </div>
                                            </a>
                                            <ul>
                                                @php
                                                    $my_second_level_users = DB::table('users')
                                                        ->where('sponcerid', $item->myrefferalcode)
                                                        ->where('status', '1')
                                                        ->get();

                                                @endphp
                                                @if ($my_second_level_users)
                                                    @foreach ($my_second_level_users as $key1)



                                                        <li>
                                                            <a href="javascript:void(0);">
                                                                <div class="member-view-box">
                                                                    <div class="member-image">
                                                                        @if ($key1->profile_photo_path)
                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                src="{{ URL::to('/') }}/{{ $key1->profile_photo_path }}">
                                                                            <br> {{ $key1->name }}
                                                                            <br>{{ $key1->email }}
                                                                        @else
                                                                            <div class="member-image"
                                                                                style="font-weight: bold;">
                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                <br> {{ $key1->name }}
                                                                                <br>{{ $key1->email }}
                                                                            </div>

                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <ul>
                                                                @php
                                                                    $my_3rd_level_users = DB::table('users')
                                                                        ->where('sponcerid', $key1->myrefferalcode)
                                                                        ->where('status', '1')
                                                                        ->get();

                                                                @endphp
                                                                @if ($my_3rd_level_users)
                                                                    @foreach ($my_3rd_level_users as $key2)
                                                                        <li>
                                                                            <a href="javascript:void(0);">
                                                                                <div class="member-view-box">
                                                                                    <div class="member-image">
                                                                                        @if ($key2->profile_photo_path)
                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                src="{{ URL::to('/') }}/{{ $key2->profile_photo_path }}">
                                                                                            <br> {{ $key2->name }}
                                                                                            <br>{{ $key2->email }}

                                                                                        @else
                                                                                            <div class="member-image"
                                                                                                style="font-weight: bold;">
                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                <br> {{ $key2->name }}
                                                                                                <br>{{ $key2->email }}

                                                                                            </div>

                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <ul>
                                                                                @php
                                                                                    $my_4_level_users = DB::table('users')
                                                                                        ->where('sponcerid', $key2->myrefferalcode)
                                                                                        ->where('status', '1')
                                                                                        ->get();

                                                                                @endphp
                                                                                @if ($my_4_level_users)
                                                                                    @foreach ($my_4_level_users as $key3)
                                                                                        <li>
                                                                                            <a href="javascript:void(0);">
                                                                                                <div
                                                                                                    class="member-view-box">
                                                                                                    <div
                                                                                                        class="member-image">
                                                                                                        @if ($key3->profile_photo_path)
                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                src="{{ URL::to('/') }}/{{ $key3->profile_photo_path }}">
                                                                                                            <br>
                                                                                                            {{ $key3->name }}
                                                                                                            <br>{{ $key3->email }}

                                                                                                        @else
                                                                                                            <div class="member-image"
                                                                                                                style="font-weight: bold;">
                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                <br>
                                                                                                                {{ $key3->name }}
                                                                                                                <br>{{ $key3->email }}

                                                                                                            </div>

                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            </a>
                                                                                            <ul>
                                                                                                @php
                                                                                                    $my_5_level_users = DB::table('users')
                                                                                                        ->where('sponcerid', $key3->myrefferalcode)
                                                                                                        ->where('status', '1')
                                                                                                        ->get();

                                                                                                @endphp
                                                                                                @if ($my_5_level_users)
                                                                                                    @foreach ($my_5_level_users as $key4)
                                                                                                        <li>
                                                                                                            <a
                                                                                                                href="javascript:void(0);">
                                                                                                                <div
                                                                                                                    class="member-view-box">
                                                                                                                    <div
                                                                                                                        class="member-image">
                                                                                                                        @if ($key4->profile_photo_path)
                                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                src="{{ URL::to('/') }}/{{ $key4->profile_photo_path }}">
                                                                                                                            <br>
                                                                                                                            {{ $key4->name }}
                                                                                                                            <br>{{ $key4->email }}

                                                                                                                        @else
                                                                                                                            <div class="member-image"
                                                                                                                                style="font-weight: bold;">
                                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                                <br>
                                                                                                                                {{ $key4->name }}
                                                                                                                                <br>{{ $key4->email }}

                                                                                                                            </div>

                                                                                                                        @endif
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </a>
                                                                                                            <ul>
                                                                                                                @php
                                                                                                                    $my_6_level_users = DB::table('users')
                                                                                                                        ->where('sponcerid', $key4->myrefferalcode)
                                                                                                                        ->where('status', '1')
                                                                                                                        ->get();

                                                                                                                @endphp
                                                                                                                @if ($my_6_level_users)
                                                                                                                    @foreach ($my_6_level_users as $key5)
                                                                                                                        <li>
                                                                                                                            <a
                                                                                                                                href="javascript:void(0);">
                                                                                                                                <div
                                                                                                                                    class="member-view-box">
                                                                                                                                    <div
                                                                                                                                        class="member-image">
                                                                                                                                        @if ($key5->profile_photo_path)
                                                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                src="{{ URL::to('/') }}/{{ $key5->profile_photo_path }}">
                                                                                                                                            <br>
                                                                                                                                            {{ $key5->name }}
                                                                                                                                            <br>{{ $key5->email }}

                                                                                                                                        @else
                                                                                                                                            <div class="member-image"
                                                                                                                                                style="font-weight: bold;">
                                                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                                                <br>
                                                                                                                                                {{ $key5->name }}
                                                                                                                                                <br>{{ $key5->email }}

                                                                                                                                            </div>

                                                                                                                                        @endif
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </a>
                                                                                                                            <ul>
                                                                                                                                @php
                                                                                                                                    $my_7_level_users = DB::table('users')
                                                                                                                                        ->where('sponcerid', $key5->myrefferalcode)
                                                                                                                                        ->where('status', '1')
                                                                                                                                        ->get();

                                                                                                                                @endphp
                                                                                                                                @if ($my_7_level_users)
                                                                                                                                    @foreach ($my_7_level_users as $key6)
                                                                                                                                        <li>
                                                                                                                                            <a
                                                                                                                                                href="javascript:void(0);">
                                                                                                                                                <div
                                                                                                                                                    class="member-view-box">
                                                                                                                                                    <div
                                                                                                                                                        class="member-image">
                                                                                                                                                        @if ($key6->profile_photo_path)
                                                                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                src="{{ URL::to('/') }}/{{ $key6->profile_photo_path }}">
                                                                                                                                                            <br>
                                                                                                                                                            {{ $key6->name }}
                                                                                                                                                            <br>{{ $key6->email }}

                                                                                                                                                        @else
                                                                                                                                                            <div class="member-image"
                                                                                                                                                                style="font-weight: bold;">
                                                                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                                                                <br>
                                                                                                                                                                {{ $key6->name }}
                                                                                                                                                                <br>{{ $key6->email }}

                                                                                                                                                            </div>

                                                                                                                                                        @endif
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </a>
                                                                                                                                            <ul>
                                                                                                                                                @php
                                                                                                                                                    $my_8_level_users = DB::table('users')
                                                                                                                                                        ->where('sponcerid', $key6->myrefferalcode)
                                                                                                                                                        ->where('status', '1')
                                                                                                                                                        ->get();

                                                                                                                                                @endphp
                                                                                                                                                @if ($my_8_level_users)
                                                                                                                                                    @foreach ($my_8_level_users as $key7)
                                                                                                                                                        <li>
                                                                                                                                                            <a
                                                                                                                                                                href="javascript:void(0);">
                                                                                                                                                                <div
                                                                                                                                                                    class="member-view-box">
                                                                                                                                                                    <div
                                                                                                                                                                        class="member-image">
                                                                                                                                                                        @if ($key7->profile_photo_path)
                                                                                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                src="{{ URL::to('/') }}/{{ $key7->profile_photo_path }}">
                                                                                                                                                                            <br>
                                                                                                                                                                            {{ $key7->name }}
                                                                                                                                                                            <br>{{ $key7->email }}

                                                                                                                                                                        @else
                                                                                                                                                                            <div class="member-image"
                                                                                                                                                                                style="font-weight: bold;">
                                                                                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                                                                                <br>
                                                                                                                                                                                {{ $key7->name }}
                                                                                                                                                                                <br>{{ $key7->email }}

                                                                                                                                                                            </div>

                                                                                                                                                                        @endif
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                            </a>
                                                                                                                                                            <ul>
                                                                                                                                                                @php
                                                                                                                                                                    $my_9_level_users = DB::table('users')
                                                                                                                                                                        ->where('sponcerid', $key7->myrefferalcode)
                                                                                                                                                                        ->where('status', '1')
                                                                                                                                                                        ->get();

                                                                                                                                                                @endphp
                                                                                                                                                                @if ($my_9_level_users)
                                                                                                                                                                    @foreach ($my_9_level_users as $key8)
                                                                                                                                                                        <li>
                                                                                                                                                                            <a
                                                                                                                                                                                href="javascript:void(0);">
                                                                                                                                                                                <div
                                                                                                                                                                                    class="member-view-box">
                                                                                                                                                                                    <div
                                                                                                                                                                                        class="member-image">
                                                                                                                                                                                        @if ($key8->profile_photo_path)
                                                                                                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                                src="{{ URL::to('/') }}/{{ $key8->profile_photo_path }}">
                                                                                                                                                                                            <br>
                                                                                                                                                                                            {{ $key8->name }}
                                                                                                                                                                                            <br>{{ $key8->email }}

                                                                                                                                                                                        @else
                                                                                                                                                                                            <div class="member-image"
                                                                                                                                                                                                style="font-weight: bold;">
                                                                                                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                                                                                                <br>
                                                                                                                                                                                                {{ $key8->name }}
                                                                                                                                                                                                <br>{{ $key8->email }}

                                                                                                                                                                                            </div>

                                                                                                                                                                                        @endif
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </a>
                                                                                                                                                                            <ul>
                                                                                                                                                                                @php
                                                                                                                                                                                    $my_10_level_users = DB::table('users')
                                                                                                                                                                                        ->where('sponcerid', $key8->myrefferalcode)
                                                                                                                                                                                        ->where('status', '1')
                                                                                                                                                                                        ->get();

                                                                                                                                                                                @endphp
                                                                                                                                                                                @if ($my_10_level_users)
                                                                                                                                                                                    @foreach ($my_10_level_users as $key9)
                                                                                                                                                                                        <li>
                                                                                                                                                                                            <a
                                                                                                                                                                                                href="javascript:void(0);">
                                                                                                                                                                                                <div
                                                                                                                                                                                                    class="member-view-box">
                                                                                                                                                                                                    <div
                                                                                                                                                                                                        class="member-image">
                                                                                                                                                                                                        @if ($key9->profile_photo_path)
                                                                                                                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                                                src="{{ URL::to('/') }}/{{ $key9->profile_photo_path }}">
                                                                                                                                                                                                            <br>
                                                                                                                                                                                                            {{ $key9->name }}
                                                                                                                                                                                                            <br>{{ $key9->email }}

                                                                                                                                                                                                        @else
                                                                                                                                                                                                            <div class="member-image"
                                                                                                                                                                                                                style="font-weight: bold;">
                                                                                                                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                                                                                                                <br>
                                                                                                                                                                                                                {{ $key9->name }}
                                                                                                                                                                                                                <br>{{ $key9->email }}

                                                                                                                                                                                                            </div>

                                                                                                                                                                                                        @endif
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                            </a>
                                                                                                                                                                                            <ul>
                                                                                                                                                                                                @php
                                                                                                                                                                                                    $my_11_level_users = DB::table('users')
                                                                                                                                                                                                        ->where('sponcerid', $key9->myrefferalcode)
                                                                                                                                                                                                        ->where('status', '1')
                                                                                                                                                                                                        ->get();

                                                                                                                                                                                                @endphp
                                                                                                                                                                                                @if ($my_11_level_users)
                                                                                                                                                                                                    @foreach ($my_11_level_users as $key10)
                                                                                                                                                                                                        <li>
                                                                                                                                                                                                            <a
                                                                                                                                                                                                                href="javascript:void(0);">
                                                                                                                                                                                                                <div
                                                                                                                                                                                                                    class="member-view-box">
                                                                                                                                                                                                                    <div
                                                                                                                                                                                                                        class="member-image">
                                                                                                                                                                                                                        @if ($key10->profile_photo_path)
                                                                                                                                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                                                                src="{{ URL::to('/') }}/{{ $key10->profile_photo_path }}">
                                                                                                                                                                                                                            <br>
                                                                                                                                                                                                                            {{ $key10->name }}
                                                                                                                                                                                                                            <br>{{ $key10->email }}

                                                                                                                                                                                                                        @else
                                                                                                                                                                                                                            <div class="member-image"
                                                                                                                                                                                                                                style="font-weight: bold;">
                                                                                                                                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                                                                                                                                <br>
                                                                                                                                                                                                                                {{ $key10->name }}
                                                                                                                                                                                                                                <br>{{ $key10->email }}

                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                            </a>
                                                                                                                                                                                                            <ul>
                                                                                                                                                                                                                @php
                                                                                                                                                                                                                    $my_12_level_users = DB::table('users')
                                                                                                                                                                                                                        ->where('sponcerid', $key10->myrefferalcode)
                                                                                                                                                                                                                        ->where('status', '1')
                                                                                                                                                                                                                        ->get();

                                                                                                                                                                                                                @endphp
                                                                                                                                                                                                                @if ($my_12_level_users)
                                                                                                                                                                                                                    @foreach ($my_12_level_users as $key11)
                                                                                                                                                                                                                        <li>
                                                                                                                                                                                                                            <a
                                                                                                                                                                                                                                href="javascript:void(0);">
                                                                                                                                                                                                                                <div
                                                                                                                                                                                                                                    class="member-view-box">
                                                                                                                                                                                                                                    <div
                                                                                                                                                                                                                                        class="member-image">
                                                                                                                                                                                                                                        @if ($key11->profile_photo_path)
                                                                                                                                                                                                                                            <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                                                                                src="{{ URL::to('/') }}/{{ $key11->profile_photo_path }}">
                                                                                                                                                                                                                                            <br>
                                                                                                                                                                                                                                            {{ $key11->name }}
                                                                                                                                                                                                                                            <br>{{ $key11->email }}

                                                                                                                                                                                                                                        @else
                                                                                                                                                                                                                                            <div class="member-image"
                                                                                                                                                                                                                                                style="font-weight: bold;">
                                                                                                                                                                                                                                                <img style="border-radius: 50%; height: 40px; width: 40px;"
                                                                                                                                                                                                                                                    src="{{ URL::to('backuser/dist/img/user2-160x160.jpg') }}">
                                                                                                                                                                                                                                                <br>
                                                                                                                                                                                                                                                {{ $key11->name }}
                                                                                                                                                                                                                                                <br>{{ $key11->email }}

                                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                        </li>
                                                                                                                                                                                                                    @endforeach
                                                                                                                                                                                                                 
                                                                                                                                                                                                                @endif

                                                                                                                                                                                                            </ul>
                                                                                                                                                                                                        </li>
                                                                                                                                                                                                    @endforeach
                                                                                                                                                                                                   
                                                                                                                                                                                                @endif

                                                                                                                                                                                            </ul>
                                                                                                                                                                                        </li>
                                                                                                                                                                                    @endforeach
                                                                                                                                                                                   
                                                                                                                                                                                @endif

                                                                                                                                                                            </ul>
                                                                                                                                                                        </li>
                                                                                                                                                                    @endforeach
                                                                                                                                                                   
                                                                                                                                                                @endif

                                                                                                                                                            </ul>
                                                                                                                                                        </li>
                                                                                                                                                    @endforeach
                                                                                                                                                   
                                                                                                                                                @endif

                                                                                                                                            </ul>
                                                                                                                                        </li>
                                                                                                                                    @endforeach
                                                                                                                                   
                                                                                                                                @endif

                                                                                                                            </ul>
                                                                                                                        </li>
                                                                                                                    @endforeach
                                                                                                                   
                                                                                                                @endif

                                                                                                            </ul>
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                @endif

                                                                                            </ul>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif

                                                                            </ul>
                                                                        </li>
                                                                    @endforeach
                                                                @endif

                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </section>
    </div>
    <script>
        $(function() {
            $('.genealogy-tree ul').hide();
            $('.genealogy-tree>ul').show();
            $('.genealogy-tree ul.active').show();
            $('.genealogy-tree li').on('click', function(e) {
                var children = $(this).find('> ul');
                if (children.is(":visible")) children.hide('fast').removeClass('active');
                else children.show('fast').addClass('active');
                e.stopPropagation();
            });
        });
    </script>
@endsection
