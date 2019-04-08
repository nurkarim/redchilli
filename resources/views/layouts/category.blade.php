 @foreach($categories as $category)
 <li><a href="#cat_{{ $category->id }}">{{ $category->name }}</a></li>
 @endforeach