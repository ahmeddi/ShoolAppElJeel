<div x-data="{tel1: '', tel2: ''}">
  <x-dialog-modal wire:model='visible' >
      <x-slot name='title'>
          <div class='relative w-full px-12 text-lg font-bold text-green-900 dark:text-gray-50 '>
            <div>
              {{ __('prof.add') }}
             </div> 
             <button wire:click="close" class="absolute top-0 rtl:left-2 ltr:right-2 z-20 flex items-center justify-center w-8 h-8 text-green-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 dark:text-gray-50">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                     </svg>
             </button>
          </div>
          
      </x-slot>

       <x-slot name='content'>
          <div  x-data="{ open: 0 ,select: 0}" class="flex flex-col space-y-4 ">
    
              {{--  top rows --}}
              <div class="grid lg:grid-cols-2 gap-x-6 gap-y-3 px-12  justify-items-center sm:grid-cols-1 ">
                  <div class="flex flex-col space-y-1">
                      <div class="flex justify-between">
                        <label for="eid"  class="labels">{{ __('prof.prof-nom') }}:</label>
                        @error('nom') <span class="danger">{{ $message }}</span> @enderror  
                      </div>
                    <input wire:model.defer='nom' class="inputs @error('nom') reds @enderror" type="text"   required  />    
                  </div>
                    
                    <div class="flex flex-col space-y-1">
                        <div class="flex justify-between">
                          <label   class="labels">{{ __('prof.prof-nomfr') }}:</label>
                          @error('nomfr') <span class="danger">{{ $message }}</span> @enderror  
                        </div>
                        <input wire:model.defer='nomfr' class="inputs @error('nomfr') reds @enderror" type="text" required  />
                    </div>

                    <div  class="flex flex-col space-y-1">
                      <div class="flex justify-between">
                        <label for="eid"  class="labels">{{ __('prof.prof-tel') }}:</label>
                        @error('tel1') <span class="danger">{{ $message }}</span> @enderror  
                      </div>
                    <div class="flex w-full  relative ">
                      <input dir="ltr"  x-model="tel1" x-mask="99 99 99 99" wire:model.defer='tel1' class="inputs @error('tel1') reds @enderror" type="text" required  />
                      <button @click="tel2 = tel1, $wire.tel2 = $wire.tel1" class=" absolute right-4 top-2">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                          </svg>
                      </button> 
                    </div>  
                  </div>

                  <div class="flex flex-col space-y-1">
                    <div class="flex justify-between">
                      <label   class="labels">{{ __('prof.prof-wh') }}:</label>
                      @error('tel2') <span class="danger">{{ $message }}</span> @enderror  
                    </div>
                    <div  dir="ltr" class=" flex w-full">
                      <input dir="ltr" lang="fr"  wire:model='whcode'  class="inputs w-2/6 mx-1 px-2 @error('whcode') reds @enderror" type="number"  required  />
                      <input dir="ltr" lang="fr" x-model="tel2" x-mask="99 99 99 99 99 99 99" wire:model.defer='tel2' class="inputs w-4/6 @error('whcode') reds @enderror" type="text" required  />
                    </div>                  
                  </div>



                  <div class="flex flex-col space-y-1">
                      <div class="flex justify-between">
                        <label   class="labels">{{ __('prof.prof-nni') }}:</label>
                        @error('nni') <span class="danger">{{ $message }}</span> @enderror  
                      </div>
                      <input wire:model.defer='nni' class="inputs" type="number" required  />
                  </div>

                  <div class="flex flex-col space-y-1">
                      <div class="flex justify-between">
                        <label   class="labels">{{ __('prof.prof-nc') }}:</label>
                        @error('se') <span class="danger">{{ $message }}</span> @enderror  
                      </div>
                      <input wire:model.defer='se' class="inputs @error('se') reds @enderror" type="number" required  />
                  </div>
              </div>

                              {{-- 2nd rows --}}
              <div class="grid lg:grid-cols-2 gap-x-6 gap-y-3 px-12  justify-items-center sm:grid-cols-1 ">
                  <div class="flex flex-col space-y-1 col-span-2 w-full">
                      <div class="flex justify-between">
                        <label   class="labels">{{ __('prof.prof-tysal') }}:</label>
                        @error('ts') <span class="danger">{{ $message }}</span> @enderror  
                      </div>
                      <select x-model="select"  wire:model.defer='ts'  class="inputs w-full @error('ts') reds @enderror" name="sexe"  required >
                          <option class="text-sm font-medium" >-----</option>
                          <option class="text-sm" value="1" >{{ __('prof.prof-fix') }}</option>
                          <option class="text-sm" value="2" >{{ __('prof.prof-rela') }}</option>
                      </select>
                  </div>

                  <div x-show="select == 1"  class="flex flex-col space-y-1 col-span-2 w-full">
                      <div class="flex justify-between">
                        <label for="eid"  class="labels">{{ __('prof.prof-sal') }}:</label>
                        @error('ms') <span class="danger">{{ $message }}</span> @enderror  
                      </div>
                    <input wire:model.defer='ms' class="inputs w-full @error('ms') reds @enderror" type="number"   required  />    
                  </div>

                  

                  <div class="flex flex-col space-y-1 col-span-2 w-full">
                      <div class="flex justify-between">
                        <label for="eid"  class="labels">{{ __('prof.prof-diplom') }}:</label>
                        @error('diplom') <span class="danger">{{ $message }}</span> @enderror  
                      </div>
                    <input wire:model.defer='diplom' class="inputs w-full @error('diplom') reds @enderror" type="text"   required  />    
                  </div>
              </div>

              
          </div>  
       </x-slot>

       <x-slot name='footer' >

          <div wire:loading class="mx-8">
              <div role="status ">
                  <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-teal-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                  <span class="sr-only">Loading...</span>
              </div>
          </div>
          <div wire:loading.remove class="flex justify-between">
           <div class='px-12'>
             
           </div>
           <div class='px-10  flex space-x-3 justify-end items-center w-full'>

            <button  wire:click="close" type="button" class="w-full inline-flex justify-center rounded-md  shadow-sm px-4 py-2 focus:outline-none bg-white border-teal-600 border hover:bg-gray-50 text-teal-700 dark:text-gray-200 dark:border-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 sm:ml-3 sm:w-auto sm:text-sm">
              {{ __('etudiants.add-cancel') }} 
            </button>
            <button wire:click='save'  type="button" class="mt-3 w-full inline-flex justify-center rounded-md border dark:border-gray-500 shadow-sm px-4 py-2 focus:outline-none bg-teal-600 hover:bg-teal-800 text-white dark:text-gray-900 dark:bg-gray-100 dark:hover:bg-gray-200 font-bold sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                  {{ __('etudiants.add-save') }} 
            </button>
          </div>
         
          </div>
       </x-slot>
  </x-dialog-modal>
</div>