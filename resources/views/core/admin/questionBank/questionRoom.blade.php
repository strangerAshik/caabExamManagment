@extends('core.layout.layoutTree')
@section('content')
<style type="text/css">
	.tree {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #fbfbfb;
  border: 1px solid #999;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05)
}

.tree li {
  list-style-type: none;
  margin: 0;
  padding: 10px 5px 0 5px;
  position: relative
}

.tree li::before,
.tree li::after {
  content: '';
  left: -20px;
  position: absolute;
  right: auto
}

.tree li::before {
  border-left: 1px solid #999;
  bottom: 50px;
  height: 100%;
  top: 0;
  width: 1px
}

.tree li::after {
  border-top: 1px solid #999;
  height: 20px;
  top: 25px;
  width: 25px
}

.tree li span {
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border: 1px solid #999;
  border-radius: 5px;
  display: inline-block;
  padding: 3px 8px;
  text-decoration: none
}

.tree li.parent_li>span {
  cursor: pointer
}

.tree>ul>li::before,
.tree>ul>li::after {
  border: 0
}

.tree li:last-child::before {
  height: 30px
}

.tree li.parent_li>span:hover,
.tree li.parent_li>span:hover+ul li span {
  background: #eee;
  border: 1px solid #94a0b4;
  color: #000
}


</style>

<div class="row">
<div class="tree well col-md-10 col-md-offset-1">
  <ul>
  @foreach($licTypes as $info)
    <li>
      <span><i class="icon-folder-open"></i> License Type:</span> <a href="#">{{$info->licence_type}}</a> [TQ:{{App\AdminModel::numberOfQestions($info->id,'licence_type')}}]
      <ul>
      <?php $subjects=App\AdminModel::getSubjects($info->id)?>
      @foreach($subjects as $sub)
        <li>
          <span><i class="icon-minus-sign"></i>Subject</span> <a href="">{{$sub->subject}}</a> [TQ:{{App\AdminModel::numberOfQestions($sub->id,'subject')}}]
          <ul>
          <?php $chapters=App\AdminModel::getChapters($info->id,$sub->id)?>
           @foreach($chapters as $chap)
            <li>
              <span><i class="icon-leaf"></i>Chapter</span> <a href="{{url('chapterQuestion/'.$info->id.'/'.$sub->id.'/'.$chap->id)}}">{{$chap->chapter}}</a> [TQ:{{App\AdminModel::numberOfQestions($chap->id,'chapter')}}]
            </li>
           @endforeach
            
          </ul>
        </li>
      @endforeach       
      </ul>
    </li>
  @endforeach
    
  
  </ul>
</div>


</div>

@stop