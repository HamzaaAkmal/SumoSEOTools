<div class="card-body">
      @switch($tool_name)

          @case('DNS Records Checker')
                @livewire('public.tools.dns-records-checker')
              @break
              
          @case('JSON to JSON Schema')
                @livewire('public.tools.json-to-json-schema')
              @break

          @case('FAQ Schema Generator')
                @livewire('public.tools.faq-schema-generator')
              @break

          @case('Text Compare')
                @livewire('public.tools.text-compare')
              @break
              
          @case('Text to Hashtags')
                @livewire('public.tools.text-to-hashtags')
              @break

          @case('Backwards Text Generator')
                @livewire('public.tools.backwards-text-generator')
              @break

          @case('YouTube Channel Search')
                @livewire('public.tools.youtube-channel-search')
              @break
              
          @case('YouTube Money Calculator')
                @livewire('public.tools.youtube-money-calculator')
              @break
              
          @case('YouTube Channel Banner Downloader')
                @livewire('public.tools.youtube-channel-banner-downloader')
              @break

          @case('YouTube Channel Logo Downloader')
                @livewire('public.tools.youtube-channel-logo-downloader')
              @break

          @case('YouTube Region Restriction Checker')
                @livewire('public.tools.youtube-region-restriction-checker')
              @break

          @case('YouTube Video Statistics')
                @livewire('public.tools.youtube-video-statistics')
              @break

          @case('YouTube Channel Statistics')
                @livewire('public.tools.youtube-channel-statistics')
              @break
              
          @case('YouTube Channel ID')
                @livewire('public.tools.youtube-channel-id')
              @break

          @case('YouTube Embed Code Generator')
                @livewire('public.tools.youtube-embed-code-generator')
              @break
              
          @case('YouTube Description Generator')
                @livewire('public.tools.youtube-description-generator')
              @break

          @case('YouTube Description Extractor')
                @livewire('public.tools.youtube-description-extractor')
              @break

          @case('YouTube Title Generator')
                @livewire('public.tools.youtube-title-generator')
              @break

          @case('YouTube Title Extractor')
                @livewire('public.tools.youtube-title-extractor')
              @break

          @case('YouTube Hashtag Generator')
                @livewire('public.tools.youtube-hashtag-generator')
              @break

          @case('YouTube Hashtag Extractor')
                @livewire('public.tools.youtube-hashtag-extractor')
              @break
              
          @case('YouTube Tag Generator')
                @livewire('public.tools.youtube-tag-generator')
              @break

          @case('YouTube Tag Extractor')
                @livewire('public.tools.youtube-tag-extractor')
              @break

          @case('YouTube Trend')
                @livewire('public.tools.youtube-trend')
              @break

          @case('URL Rewriting Tool')
                @livewire('public.tools.url-rewriting-tool')
              @break
              
          @case('Backlink Checker')
                @livewire('public.tools.backlink-checker')
              @break

          @case('Article Rewriter')
                @livewire('public.tools.article-rewriter')
              @break

          @case('Keywords Suggestion Tool')
                @livewire('public.tools.keywords-suggestion-tool')
              @break
              
          @case('Adsense Calculator')
                @livewire('public.tools.adsense-calculator')
              @break
              
          @case('WordPress Theme Detector')
                @livewire('public.tools.wordpress-theme-detector')
              @break

          @case('Credit Card Validator')
                @livewire('public.tools.credit-card-validator')
              @break
              
          @case('Credit Card Generator')
                @livewire('public.tools.credit-card-generator')
              @break

          @case('URL Opener')
                @livewire('public.tools.url-opener')
              @break

          @case('Page Size Checker')
                @livewire('public.tools.page-size-checker')
              @break

          @case('Screen Resolution Simulator')
                @livewire('public.tools.screen-resolution-simulator')
              @break
              
          @case('What Is My Screen Resolution')
                @livewire('public.tools.what-is-my-screen-resolution')
              @break

          @case('Twitter Card Generator')
                @livewire('public.tools.twitter-card-generator')
              @break

          @case('Get HTTP Headers')
                @livewire('public.tools.get-http-headers')
              @break

          @case('Open Graph Generator')
                @livewire('public.tools.open-graph-generator')
              @break

          @case('Open Graph Checker')
                @livewire('public.tools.open-graph-checker')
              @break

          @case('What Is My User Agent')
                @livewire('public.tools.what-is-my-user-agent')
              @break

          @case('What Is My Browser')
                @livewire('public.tools.what-is-my-browser')
              @break
              
          @case('Hosting Checker')
                @livewire('public.tools.hosting-checker')
              @break

          @case('Server Status Checker')
                @livewire('public.tools.server-status-checker')
              @break

          @case('Moz Rank Checker')
                @livewire('public.tools.moz-rank-checker')
              @break

          @case('Meta Tags Analyzer')
                @livewire('public.tools.meta-tags-analyzer')
              @break

          @case('Meta Tag Generator')
                @livewire('public.tools.meta-tag-generator')
              @break

          @case('Whois Domain Lookup')
                @livewire('public.tools.whois-domain-lookup')
              @break

          @case('Htaccess Redirect Generator')
                @livewire('public.tools.htaccess-redirect-generator')
              @break

          @case('DA PA Checker')
                @livewire('public.tools.da-pa-checker')
              @break
              
          @case('Page Authority Checker')
                @livewire('public.tools.page-authority-checker')
              @break

          @case('Domain Authority Checker')
                @livewire('public.tools.domain-authority-checker')
              @break

          @case('Domain Age Checker')
                @livewire('public.tools.domain-age-checker')
              @break

          @case('HTTP Status Code Checker')
                @livewire('public.tools.http-status-code-checker')
              @break

          @case('Domain to IP')
                @livewire('public.tools.domain-to-ip')
              @break

          @case('Robots.txt Generator')
                @livewire('public.tools.robots-txt-generator')
              @break

          @case('Google Cache Checker')
                @livewire('public.tools.google-cache-checker')
              @break

          @case('Google Index Checker')
                @livewire('public.tools.google-index-checker')
              @break

          @case('Redirect Checker')
                @livewire('public.tools.redirect-checker')
              @break

          @case('Keyword Density Checker')
                @livewire('public.tools.keyword-density-checker')
              @break
              
          @default
      @endswitch
</div>