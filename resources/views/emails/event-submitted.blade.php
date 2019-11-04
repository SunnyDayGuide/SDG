@component('mail::message')
# An Event has been submitted for {{ $event['market'] }}

## Event Information
* <strong>Event:</strong> {{ $event['title'] }}
* <strong>Start Date:</strong> {{ $event['start_date'] }}
* <strong>End Date:</strong> {{ $event['end_date'] }}
* <strong>Start Time:</strong> {{ $event['start_time'] }}
* <strong>End Time:</strong> {{ $event['end_time'] }}
* <strong>Description:</strong> {{ $event['description'] }}
* <strong>Location:</strong> {{ $event['location'] }}
* <strong>Phone:</strong> {{ $event['phone'] }}
* <strong>Website</strong> {{ $event['website_url'] }}
* <strong>Tickets:</strong> {{ $event['ticket_url'] }}
* <strong>Facebook:</strong> {{ $event['facebook_url'] }}

## Contact Information
* <strong>Name:</strong> {{ $event['name'] }}
* <strong>Email:</strong> {{ $event['email'] }}
* <strong>Company/Organization:</strong> {{ $event['company'] }}
* <strong>Cookie Consent:</strong> {{ $event['cookie_consent'] }}
@endcomponent

@component('mail::button', ['url' => url("/nova/resources/events/new")])
Create Event Now
@endcomponent