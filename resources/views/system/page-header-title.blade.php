<div class="page-title-container">
    <i class="{{trans($icon)}} page-icon"></i>
    <span class="page-title">{{trans($title)}}</span>
    <small>{{trans($description)}}</small>
    <div class="pull-right">
        <a href="{{ URL::previous() }}" class="btn-back text-uppercase">
            <i class="fa fa-arrow-circle-left"></i> {{trans('cms::button.back')}}
        </a>
    </div>
</div>
