@props(['type','message'])

<div {{$attributes->merge(['class'=>'alert alert-'.$type])}}>
    {{$message}}
</div>
<ul>
    <li>
        whereStartsWith: {{$attributes->whereStartsWith('data')}}
    </li>
    <li>
        whereDoesntStartWith: {{$attributes->whereDoesntStartWith('data')}}
    </li>
    <li>
        has: {{$attributes->has('class')}}
    </li>
    <li>
        get: {{$attributes->get('class')}}
    </li>
    <li>
        filter: {{$attributes->filter(fn(string $value,string $key)=>$key == 'data-id')}}
    </li>
</ul>