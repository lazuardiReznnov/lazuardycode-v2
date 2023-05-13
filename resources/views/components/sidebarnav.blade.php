<ul {{ $attributes->
    class('sidebar-nav')->merge(['id'=>'sidebar-nav']) }}>
    {{
        $slot
    }}
</ul>
