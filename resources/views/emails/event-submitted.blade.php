@component('mail::message')
# An Event has been submitted for {{ $event['market'] }}

## Event Information
* __Event:__ {{ $event['title'] }}
* __Start Date:__ {{ $event['start_date'] }}
* __End Date:__ {{ $event['end_date'] }}
* __Start Time:__ {{ $event['start_time'] }}
* __End Time:__ {{ $event['end_time'] }}
* __Description:__ {{ $event['description'] }}
* __Location:__ {{ $event['location'] }}
* __Phone:__ {{ $event['phone'] }}
* __Website__ {{ $event['website_url'] }}
* __Tickets:__ {{ $event['ticket_url'] }}
* __Facebook:__ {{ $event['facebook_url'] }}

## Contact Information
* __Name:__ {{ $event['name'] }}
* __Email:__ {{ $event['email'] }}
* __Company/Organization:__ {{ $event['company'] }}
* __Cookie Consent:__ {{ $event['cookie_consent'] }}

@component('mail::button', ['url' => url("/nova/resources/events/new")])
Create Event Now
@endcomponent