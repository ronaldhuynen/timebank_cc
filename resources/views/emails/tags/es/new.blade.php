@component('mail::message')
{{-- Hello {{ $model->name }}, --}}

A new tag has been added: <br><br>

{{-- @component('mail::panel') --}}
Name: {{ $tagInfo['tag'] }} <br />
Id: {{ $tagInfo['tag_id'] }} <br />
Category path: {{ $tagInfo['category_path'] }} <br />
Locale: {{ $tagInfo['locale']['locale'] }} <br />
Example: {{ $tagInfo['locale']['example'] }} <br />
Created by user: {{ $tagInfo['locale']['updated_by_user'] }} <br />
Created at: {{ $tagInfo['locale']['created_at'] }} <br />

@component('mail::message')
