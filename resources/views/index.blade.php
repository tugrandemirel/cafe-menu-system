<!doctype html>
<html class="no-js" lang="tr" >

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>{{ $setting->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $setting->description }}" />
    <meta name="keywords" content="{{ $setting->keywords }}" />
    <meta name="author" content="Tuğran Demirel" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="google" content="nositelinkssearchbox" />
    <meta name="google" content="notranslate" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&amp;family=Pacifico:wght@100;200;400;500&amp;display=swap" rel="stylesheet">
    <!-- CSS Core -->
    <link rel="stylesheet" href="{{ asset('assets/menu/core.css') }}" />
    <!-- CSS Theme -->
    <link id="theme" rel="stylesheet" href="{{ asset('assets/menu/theme-beigeae52.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>


<body style="margin: 0!important; padding: 0!important;">

<!-- Header -->
<header id="header-mobile" class="light">

    <div class="module module-logo">
        <img src="{{ $setting->logo }}" alt="{{ $setting->title }}  " style="height: 75px;">
    </div>
</header>
<!-- Content -->
<div id="content">


    <div class="page-content">
        <div class="container">
            <ul class="nav  nav-pills " role="tablist">
                @foreach($menus as $menu)
                    <li class="nav-item">
                        <a id="tab-{{ $menu->id }}" href="#pane-{{ $menu->id }}" class="nav-link {{ $loop->iteration === 1 ? 'active' : null  }}" data-toggle="tab" role="tab">{{ strtoupper($menu->name) }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" role="tablist">
                @foreach($menus as $menu)
                <div id="pane-{{ $menu->id }}" class="card tab-pane fade {{ $loop->iteration === 1 ? 'show' : null  }} {{ $loop->iteration === 1 ? 'active' : null  }}" role="tabpanel" aria-labelledby="tab-{{ $menu->id }}">

                    <div class="card-body">
                        @foreach($menu->submenus as $submenu)
                        <div id="{{ $submenu->id }}" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menu{{ $submenu->id }}Content" data-toggle="collapse" aria-expanded="true">
                                <div class="bg-image">
                                    <img loading="lazy" src="{{ asset($submenu->image) }}" alt="{{ $submenu->name }}"></div>
                                <h2 class="title">{{ $submenu->name }}</h2>
                            </div>
                            <div id="menu{{ $submenu->id }}Content" class="menu-category-content collapse ">
                                <!-- Menu Item -->
                                @foreach($submenu->subproducts as $product)
                                    <div class="menu-item menu-list-item">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <img src="{{ asset($product->image) }}" loading="lazy" class="lazy" alt="{{ $product->name }}" />
                                            </div>
                                            <div class="col-6 mb-2 mb-sm-0">
                                                <h6 class="mb-0">{{ $product->name }}</h6>
                                                <span class="text-muted text-sm">{{ $product->description }}</span>
                                            </div>
                                            <div class="col-3 text-sm-right">
                                                <span class="text-md"><span data-product-base-price>{{ $product->price - $product->discount }}₺</span></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Footer -->

    <footer id="" class="bg-dark dark pt-4" style="background-color: #ddae71!important;">
        <!-- Footer 2nd Row -->
            <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="widget">
                                        <h4 class="widget-title">Hakkımızda</h4>
                                        <p>{{ $setting->description }}</p>
                                    <a type="button" class="" data-toggle="modal" data-target="#exampleModal" >İstek/Şikayet</a>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header " >
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">İstek/Şikayet</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form style="border-color: black;" method="POST" action="{{ route('contact') }}">
                                                <div class="modal-body" style="color: black;">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Ad-Soyad:</label>
                                                            <input type="text" class="form-control" name="name" id="recipient-name" required  style="  border-bottom-color: #cccccc; color: black;">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">E-mail</label>
                                                            <input type="email" class="form-control" name="email" id="recipient-name" required  style="  border-bottom-color: #cccccc; color: black;">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">İstek/Şikayet:</label>
                                                            <textarea class="form-control" name="message" id="message-text"required style="border-bottom-color: #cccccc; color: black;"></textarea>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                                    <button type="submit" class="btn btn-primary">Gönder</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="widget">
                                    <h4 class="widget-title">İletişim</h4>
                                    <ul class="contact-info">
                                        @if(isset($setting->address))
                                            <li>
                                                <span class="contact-info-label">Adres:</span>
                                                <span class="contact-info-value">{{ $setting->address }}</span>
                                            </li>
                                        @endif
                                        @if(isset($setting->phone))
                                            <li>
                                                <span class="contact-info-label">Telefon:</span>
                                                <span class="contact-info-value">{{ $setting->phone }}</span>
                                            </li>
                                            @endif
                                        @if(isset($setting->email))
                                            <li>
                                                <span class="contact-info-label">E-mail:</span>
                                                <span class="contact-info-value">{{ $setting->email }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="widget">
                                    <h4 class="widget-title">Sosyal Medya</h4>
                                    <ul class="social-icons social-icons-colored">
                                        @if(isset($social_media->facebook))
                                            <li class="social-icons-facebook">
                                                <a href="{{ $social_media->facebook }}" target="_blank" title="Facebook">
                                                    <i class="fab fa-facebook-f"></i> Facebook
                                                </a>
                                            </li>
                                        @endif
                                        @if(isset($social_media->twitter))
                                            <li class="social-icons-twitter">
                                                <a href="{{ $social_media->twitter }}" target="_blank" title="Twitter">
                                                    <i class="fab fa-twitter"></i> Twitter
                                                </a>
                                            </li>
                                        @endif
                                        @if(isset($social_media->instagram))
                                            <li class="social-icons-instagram">
                                                <a href="{{ $social_media->instagram }}" target="_blank" title="Instagram">
                                                    <i class="fab fa-instagram"></i> Instagram
                                                </a>
                                            </li>
                                        @endif
                                        @if(isset($social_media->youtube))
                                            <li class="social-icons-youtube">
                                                <a href="{{ $social_media->youtube }}" target="_blank" title="Youtube">
                                                    <i class="fab fa-youtube"></i> Youtube
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
            </div>
    </footer>

    <!-- Footer / End -->
</div>
<!-- Content / End -->
<!-- JS Core -->
<script src="{{ asset('assets/menu/core5e1f.js') }}"></script>

</body>
</html>
