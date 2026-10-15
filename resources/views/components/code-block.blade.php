@props(['label', 'tone' => 'neutral', 'code'])

<figure class="code code--{{ $tone }}">
    <figcaption>
        <span>{{ $label }}</span>
        <button type="button" class="copy" aria-label="Copiar código ({{ $label }})">Copiar</button>
    </figcaption>
    <pre><code class="language-php">{{ $code }}</code></pre>
</figure>
