<div class="row carousel-holder">

    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($slides as $slide)
                    <li data-target="#carousel-example-generic" data-slide-to="{{$loop->index}}" class="{{$loop->first ? 'active' : ''}}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($slides as $slide)
                    <div class="item {{$loop->first ? 'active' : ''}}">
                        <img class="slide-image" src="{{$slide->photo}}" alt="images">
                    </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>

</div>