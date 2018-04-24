<div class="col-md-3">
    <div class="list-group">
        @foreach($categories as $category)
            <div class="dropdown">
                <button class="list-group-item dropdown-toggle" type="button" data-toggle="dropdown">{{$category->name}}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    @foreach($category->subCategories as $subCategory)
                        <li><a href="">{{$subCategory->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>