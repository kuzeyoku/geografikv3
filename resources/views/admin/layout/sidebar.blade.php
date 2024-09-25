<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <ul>
                        <li class="@if (!request()->segment(2)) active @endif">
                            <a href="{{ route('admin.index') }}">
                                <i data-feather="grid"></i><span>@lang('admin/home.title')</span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                               class="@if (request()->segment(2) == 'setting') subdrop active @endif">
                                <i data-feather="settings"></i>
                                <span>@lang('admin/setting.title')</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                @foreach (App\Enums\SettingCategoryEnum::cases() as $setting)
                                    <li>
                                        <a href="{{ route('admin.setting', ['category' => $setting->value]) }}">{{ $setting->title() }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @if (config('module.message.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Message->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Message->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Message->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Message->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Message->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.media.status'))
                            <li class="@if (request()->segment(2) == App\Enums\ModuleEnum::Media->value) active @endif">
                                <a href="{{ route('admin.' . App\Enums\ModuleEnum::Media->route() . '.index') }}">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Media->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Media->menuTitle() }}</span>
                                </a>
                            </li>
                        @endif
                        @if (config('module.menu.status'))
                            <li class="@if (request()->segment(2) == App\Enums\ModuleEnum::Menu->value) active @endif">
                                <a href="{{ route('admin.' . App\Enums\ModuleEnum::Menu->route() . '.index') }}">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Menu->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Menu->menuTitle() }}</span>
                                </a>
                            </li>
                        @endif
                        @if (config('module.blog.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Blog->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Blog->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Blog->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Blog->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Blog->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.page.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Page->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Page->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Page->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Page->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Page->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.user.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::User->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::User->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::User->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::User->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::User->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.language.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Language->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Language->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Language->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Language->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Language->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.category.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Category->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Category->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Category->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Category->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Category->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if(config("module.sector.status"))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Sector->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Sector->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Sector->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Sector->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Sector->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.service.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Service->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Service->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Service->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Service->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Service->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.project.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Project->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Project->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Project->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Project->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Project->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.product.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Product->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Product->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Product->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Product->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Product->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.slider.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Slider->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Slider->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Slider->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Slider->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Slider->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.brand.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Brand->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Brand->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Brand->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Brand->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Brand->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.reference.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Reference->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Reference->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Reference->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Reference->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Reference->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.testimonial.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Testimonial->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Testimonial->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Testimonial->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Testimonial->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Testimonial->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (config('module.popup.status'))
                            <li class="submenu">
                                <a href="javascript:void(0);"
                                   class="@if (request()->segment(2) == App\Enums\ModuleEnum::Popup->value) subdrop active @endif">
                                    <i data-feather="{{ App\Enums\ModuleEnum::Popup->icon() }}"></i>
                                    <span>{{ App\Enums\ModuleEnum::Popup->menuTitle() }}</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    @foreach (App\Services\Admin\SidebarService::getMenu(App\Enums\ModuleEnum::Popup->value) as $key => $value)
                                        <li>
                                            <a href="{{ route('admin.' . App\Enums\ModuleEnum::Popup->route() . '.' . $key) }}">{{ $value }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
