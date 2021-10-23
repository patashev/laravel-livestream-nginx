<div class="row pb-3">
    @foreach($paginator as $item)
        <div class="col-md-6">
            <div class="news">

                <figure>
                    <a href="/videos/video_entry/{{ $item->id }}" title="{{ $item->cover_photo->title }}">
                        <img src="{{ $item->cover_photo->thumbUrl }}">
                    </a>
                </figure>

                <div class="media mt-2">
                    <div class="media-left mr-2">
                        <div class="date bg-primary mr-2">
                            {!! $item->created_at->format('\<\s\t\r\o\n\g\>d\</\s\t\r\o\n\g\> M Y') !!}
                        </div>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading text-primary" style="font-weight: 550;">
                          <?php echo substr( $item->title, 0, 160 )?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@include('website.partials.paginator_footer')
