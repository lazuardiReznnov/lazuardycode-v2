<ul {{$attributes->
    class('nav-content')->merge(['data-bs-parent'=>'#sidebar-nav'])}}>
    {{
        $slot
    }}
</ul>
