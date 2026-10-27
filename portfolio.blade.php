@extends('layouts.app')

@section('content')
<header class="nav">
    <div class="container nav-inner">
        <a href="#home" class="logo">{{ $p['name'] }}</a>
        <nav>
            <a href="#about">About</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
        </nav>
    </div>
</header>

<section id="home" class="hero">
    <div class="container">
        <p class="eyebrow">Hello, I'm</p>
        <h1>{{ $p['name'] }}</h1>
        <h2>{{ $p['title'] }}</h2>
        <p class="lead">{{ $p['tagline'] }}</p>
        <div class="actions">
            <a href="#projects" class="btn">View My Work</a>
            <a href="#contact" class="btn btn-outline">Contact Me</a>
        </div>
    </div>
</section>

<section id="about" class="section">
    <div class="container">
        <h3 class="section-title">About Me</h3>
        <p class="about-text">{{ $p['about'] }}</p>

        <h4 class="sub-title">Skills</h4>
        <div class="chips">
            @foreach ($p['skills'] as $skill)
                <span class="chip">{{ $skill }}</span>
            @endforeach
        </div>
    </div>
</section>

<section id="projects" class="section alt">
    <div class="container">
        <h3 class="section-title">Projects</h3>
        <div class="grid">
            @foreach ($p['projects'] as $project)
                <article class="card">
                    <h4>{{ $project['title'] }}</h4>
                    <p>{{ $project['description'] }}</p>
                    <div class="chips">
                        @foreach ($project['tags'] as $tag)
                            <span class="chip small">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <a href="{{ $project['url'] }}" class="link">View project &rarr;</a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="contact" class="section">
    <div class="container narrow">
        <h3 class="section-title">Get In Touch</h3>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="form">
            @csrf
            <label>Name
                <input type="text" name="name" value="{{ old('name') }}" required>
            </label>
            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <label>Message
                <textarea name="message" rows="5" required>{{ old('message') }}</textarea>
            </label>
            <button type="submit" class="btn">Send Message</button>
        </form>

        <div class="socials">
            @foreach ($p['socials'] as $social)
                <a href="{{ $social['url'] }}" target="_blank" rel="noopener">{{ $social['label'] }}</a>
            @endforeach
            <a href="mailto:{{ $p['email'] }}">{{ $p['email'] }}</a>
        </div>
    </div>
</section>
@endsection