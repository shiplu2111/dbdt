<style type="text/css">
    .my-active span{
        background-color: #5cb85c !important;
        color: white !important;
        border-color: #5cb85c !important;
    }
</style>
@if ($paginator->hasPages())
<ul class="pagination pagination-sm m-0 " style="text-align: center" >
   
    @if ($paginator->onFirstPage())
        <li class="disabled page-item  paginate_button "><span class="page-link ">←</span></li>
    @else
        <li style="float: left;" class="page-item paginate_button"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">←</a></li>
    @endif


  
    @foreach ($elements as $element)
       
        @if (is_string($element))
            <li class="disabled page-item"><span class="page-link">{{ $element }}</span></li>
        @endif


       
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active my-active page-item"><span  class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach


    
    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">→</a></li>
    @else
        <li class="disabled page-item"><span  class="page-link">→</span></li>
    @endif
</ul>
@endif 