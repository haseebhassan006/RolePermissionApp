@php
$sidebar=sideBarMenu();
@endphp
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('assets/dist/images/logo.svg') }}">
        <span class="hidden xl:block text-white text-lg ml-3"> Ru<span class="font-medium">bick</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>

        @foreach ($sidebar as $menu)
        @if(!empty($menu['single_link']))
        <li>
            <router-link to="{{$menu['single_link']['v-route']}}" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="{{$menu['single_link']['icon']}}"></i></div>
                <div class="side-menu__title"> {{$menu['single_link']['title']}}</div>
            </router-link>
        </li>
        @endif
        @if(!empty($menu['menu']))
         <li>
            <a href="javascript:void(0)" class="side-menu side-menu">
                <div class="side-menu__icon"> <i data-feather="{{$menu['menu']['icon']}}"></i> </div>
                <div class="side-menu__title">
                    {{$menu['menu']['title']}}
                    <div class="side-menu__sub-icon transform rotate-180"> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__sub-open">
                @foreach ($menu['menu']['sub_menu'] as $item)
                <li>
                    <router-link to="{{$item['v-route']}}" class="side-menu side-menu--active">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> {{$item['title']}} </div>
                    </router-link>
                </li>
                @endforeach
            </ul>
        </li>
         @endif
        @endforeach
    </ul>
</nav>
