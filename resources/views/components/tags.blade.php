<style>
    .tags
    {

    }

    .tags a
    {
        font:13px 'Segoe UI', sans-serif;
        margin:0 .2em;
        border-radius:3px;
        color: #636065;
        /*color:#676767;*/
        text-decoration:none;
        line-height:2.0em;
        transition:all 300ms ease 0s;
    }
    .tags a:hover
    {
        color:#5f93f3;
        /*background: #eff3ee;*/
    }
</style>
<div class="tags">
    <div>
        @foreach($tags as $tag)
            {!! '<a style="font-size:'. rand(10, 18) .'px" href="'. url('tag'). '/' .$tag->id .'">'. $tag->name .'</a>' !!}
        @endforeach
    </div>
</div>
