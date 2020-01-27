@component('mail::message')
@component('mail::panel')
<strong>Market:</strong> {{ $contact->market->name }}  
<strong>Department:</strong> {{ $contact->contact_type }}

<strong>Comment:</strong> {!! $contact->comment !!}
@endcomponent

## Contact Information
<strong>Name:</strong> {{ $contact->full_name }}  
<strong>Email:</strong> {{ $contact->email }}

<small><strong>Sunny Day Newsletter Consent:</strong> {{ $contact->sdg_consent ? 'Yes' : 'No' }}</small>  
<small><strong>Cookie Consent:</strong> {{ $contact->cookie_consent ? 'Yes' : 'No' }}</small>

@endcomponent