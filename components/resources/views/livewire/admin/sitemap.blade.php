<div class="card">
    <div class="card-body">
        <p>{{ __('The sitemap is automatically generated, so you don\'t need to do anything other than submit it to Google Search Console, Bing, or other search engines.') }}</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <tbody>
                <tr>
                    <td class="align-middle bg-light fw-bold">{{ __('Sitemap URL') }}</td>
                    <td class="align-middle">{{ url('/sitemap.xml') }}</td>
                </tr>
                <tr>
                    <td class="align-middle bg-light fw-bold">{{ __('Sitemap File') }}</td>
                    <td class="align-middle">
                        <a href="{{ url('/sitemap.xml') }}" class="btn bg-gradient-success mb-0" target="_blank">
                            <i class="fas fa-link me-1"></i>
                            {{ __('View Sitemap File') }}
                        </a>
                    </td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
</div>