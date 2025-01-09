@component('mail::message')
{{-- Hello {{ $model->name }}, --}}

A new tag has been added: <br><br>

{{-- @component('mail::panel') --}}
Name: {{ $tagInfo['tag'] }} <br />
Example: {{ $tagInfo['locale']['example'] }} <br />
Category path: {{ $tagInfo['category_path'] }} <br />


Id: {{ $tagInfo['tag_id'] }} <br />
Locale: {{ $tagInfo['locale']['locale'] }} <br />
Created by user: {{ $tagInfo['locale']['updated_by_user'] }} <br />
Created at: {{ $tagInfo['locale']['created_at'] }} <br />


{{ config('app.name') }}
@endcomponent