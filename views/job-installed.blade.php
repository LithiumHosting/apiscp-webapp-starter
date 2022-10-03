@component('email.indicator', ['status' => 'success'])
	Your application is installed.
@endcomponent

@component('mail::message')
{{-- Body --}}
# Howdy!

{{ $appname }} has been successfully installed on {{ $uri }}!

## Wiki Login
You can access the Wiki at [{{$proto}}{{$uri}}]({{$proto}}{{$uri}}) using the following information:

**Login**: <code>{{$adminuser}}</code><br/>
**Password**: <code>{{ str_replace('@', '\\@', $adminpassword) }}</code>

If you wish to further configure {{ $appname }}, please refer to [the official documentation](https://www.mediawiki.org/wiki/Manual:Configuration_settings).

@include('email.webapps.common-footer')
@endcomponent