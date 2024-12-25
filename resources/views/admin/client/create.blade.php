   <x-layouts.admin.master>
       <x-data-display.card>
           <x-slot name="header">
               <div class="d-flex justify-content-between align-items-center">
                   <h5 class="card-title">{{ __('Create Client') }}</h5>
                   <x-action.link href="{{ route('clients.index') }}"
                       icon="ri-list-check">{{ __('Client List') }}</x-action.link>
               </div>
           </x-slot>
           <x-data-entry.form action="{{ route('clients.store') }}">
               <x-data-entry.input type="text" name="name" label="Name" placeholder="Name" required />
               <x-data-entry.input type="tel" name="number" label="Phone Number" placeholder="Phone Number"
                   required />
               <x-data-entry.input type="email" name="email" label="Email" placeholder="Email" />
               <x-data-entry.text-area name="address" label="Address" placeholder="Address" />
               <x-data-entry.text-area name="work_details" label="Work Details" placeholder="Work Details" />
               {{-- <x-data-entry.uploader-dropzone name="image" label="Image" /> --}}
               <x-data-entry.input type="file" name="image" label="Image" />
           </x-data-entry.form>
       </x-data-display.card>
   </x-layouts.admin.master>
