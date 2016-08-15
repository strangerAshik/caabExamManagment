@extends('core.layout.layoutExamine')
@section('content')
			
			
 			<!--Professional Info-->
			@include('core.examine.personalInfo.personalData')
  			@yield('personalData')
 			<!--Academic Data-->
			@include('core.examine.personalInfo.academicData')
			@yield('academicData')
			<!--Professional Info-->
            @include('core.examine.personalInfo.professionalData')
 			@yield('professionalData')

@stop