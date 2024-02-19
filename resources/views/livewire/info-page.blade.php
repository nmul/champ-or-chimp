<div class="container p-5 mx-auto mt-2 custom-bg-color">

    <div id="main-info-wrapper" class="min-h-full">
        <h1 class="mb-3 text-3xl font-bold text-center underline custom-red-text">Welcome to Champ or Chimp</h1>

        <p class="p-3 text-2xl text-center custom-orange-text">Know it all already? Go straight to entry form!</p>
        <div class="flex justify-center">
            <button class="h-10 px-3 py-2 mx-2 text-base font-medium text-white border border-gray-700 rounded-e hover:bg-gray-900 hover:text-white custom-bg-red-color"><a href="{{ URL('entry') }}">Enter Now</a></button>
        </div>

        <p class="p-3 text-xl">Read below to learn how to take part in the most exciting sport prediction competition out there, and be in with a chance to win amazing prizes courtesy of FlyShannon!</p>
    </div>

    <div class="container p-5 mx-auto mt-2 custom-bg-color" x-data="
    {
    openFaq1: false,
    openFaq2: false,
    openFaq3: false,
    openFaq4: false,
    openFaq5: false,
    openFaq6: false,
    openFaq7: false,
    openFaq8: false,
    }
    ">

        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4 lg:w-1/2" id="leftHalfOfInfo">
                <div
                class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8"
                >
                <button
                    class="flex w-full text-left faq-btn"
                    @click="openFaq1 = !openFaq1"
                    >
                    <div
                        class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg"
                        >
                        <svg
                            :class="openFaq1 && 'rotate-180'"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                            d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                            fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div class="w-full">
                        <h4
                            class="mt-1 text-lg font-semibold text-black "
                            >
                            What is Champ or Chimp?
                        </h4>
                    </div>
                </button>
                <div x-show="openFaq1" class="faq-content pl-[62px]">
                    <p
                        class="py-3 text-base leading-relaxed text-body-color"
                        >
                        Champ or Chimp is the ultimate Sports Prediction Competition, now in it's 11<sup>th</sup> year.
                        The competition comprises of 14 Sporting Events, the challenge for you is to predict the winner of each of these events. You will receive regular updates by email on how you are doing after each event.</br>
                       <p><strong>>Proceeds from the competition benefit many sporting bodies and charities in the Mid-West Region.</strong</p>
                    </p>
                </div>
                </div>
                <div
                class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8"
                >
                <button
                    class="flex w-full text-left faq-btn"
                    @click="openFaq2 = !openFaq2"
                    >
                    <div
                        class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg"
                        >
                        <svg
                            :class="openFaq2 && 'rotate-180'"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                            d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                            fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div class="w-full">
                        <h4
                            class="mt-1 text-lg font-semibold text-black "
                            >
                            When does the competition start and end?
                        </h4>
                    </div>
                </button>
                <div x-show="openFaq2" class="faq-content pl-[62px]">
                    <p
                        class="py-3 text-base leading-relaxed text-body-color"
                        >
                        The Competition begins with the Cheltenham Champion Hurdle in March and runs until the Camogie Final in September.
                        <br><br>
                        <strong>The closing date for Entries is 11<sup>th</sup> March 2024.</strong>
                    </p>
                </div>
                </div>
                <div
                class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8"
                >
                <button
                    class="flex w-full text-left faq-btn"
                    @click="openFaq3 = !openFaq3"
                    >
                    <div
                        class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg"
                        >
                        <svg
                            :class="openFaq3 && 'rotate-180'"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                            d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                            fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div class="w-full">
                        <h4
                            class="mt-1 text-lg font-semibold text-black "
                            >
                            What are the prizes?
                        </h4>
                    </div>
                </button>
                <div x-show="openFaq3" class="faq-content pl-[62px]">
                    <p
                        class="text-base leading-relaxed text-body-color"
                        >
                        <ul style="list-style: circle;">
                            <li><span class="mr-1">1st:</span> 2 Return Flights Shannon - Las Vegas + $1,000.00</li>
                            <li><span class="mr-1">2nd:</span> 2 Return Flights Shannon - Chicago</li>
                            <li><span class="mr-1">3rd:</span> €500.00 Fly Shannon Voucher</li>
                            <li><span class="mr-1">4th:</span> 2 Return Flights Shannon - Lanzarote</li>
                            <li><span class="mr-1">5th:</span> 2 Return Flights Shannon - Gran Canaria</li>
                            <li><span class="mr-1">6th:</span> 2 Return Flights Shannon - Faro</li>
                            <li><span class="mr-1">7th:</span> 2 Return Flights Shannon - Naples</li>
                        </ul>
                        <p class="text-base leading-relaxed text-body-color dark:text-black-6">
                        </br>
                            <h3>Additional Prizes</h3>
                            <ul style="list-style: circle;">
                                <li><span class="mr-1">US Masters</span>: 2 Return Flights Shannon - Corfu</li>
                                <li><span class="mr-1">Champions Cup</span>: 2 Return Flights Shannon - Beziers</li>
                                <li><span class="mr-1">British Open</span>: 2 Return Flights Shannon - Porto</li>
                                <li><span class="mr-1">Hurling</span>: 2 Return Flights Shannon - Paris</li>
                            </ul>
                            </br>
                            <h2>All entrants will be included im a draw for a €250.00 FlyShannon.ie Voucher.</h2>
                        </p>
                    </p>
                </div>
                </div>
                <div
                class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8"
                >
                <button
                    class="flex w-full text-left faq-btn"
                    @click="openFaq7 = !openFaq7"
                    >
                    <div
                        class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg"
                        >
                        <svg
                            :class="openFaq7 && 'rotate-180'"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                            d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                            fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div class="w-full">
                        <h4
                            class="mt-1 text-lg font-semibold text-black "
                            >
                            What are double points events?
                        </h4>
                    </div>
                </button>
                <div x-show="openFaq7" class="faq-content pl-[62px]">
                    <p
                        class="text-base leading-relaxed text-body-color"
                        >
                        You nominate 4 events as your Double Points selection. Any points you receive for these 4 events will be doubled. If you don't fill in this portion of the entry form, you will be assigned events.
                    </p>
                </div>
                </div>
            </div>
            <div class="w-full px-4 lg:w-1/2" id="rightHalfOfInfo">
                <div
                class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8"
                >
                <button
                    class="flex w-full text-left faq-btn"
                    @click="openFaq4 = !openFaq4"
                    >
                    <div
                        class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg"
                        >
                        <svg
                            :class="openFaq4 && 'rotate-180'"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                            d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                            fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div class="w-full">
                        <h4
                            class="mt-1 text-lg font-semibold text-black "
                            >
                            How is the competition scored?
                        </h4>
                    </div>
                </button>
                <div x-show="openFaq4" class="faq-content pl-[62px]">
                    <p
                        class="py-3 text-base leading-relaxed text-body-color"
                        >
                        Events are grouped into catagories for the purpose of awarding points. There are 3 Catagories ("A", "B", "C") based on the format of the event and the degree of difficulty in predicting the winner. See below for details.
                    </p>
                </div>
                </div>
                <div
                class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8"
                >
                <button
                    class="flex w-full text-left faq-btn"
                    @click="openFaq5 = !openFaq5"
                    >
                    <div
                        class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg"
                        >
                        <svg
                            :class="openFaq5 && 'rotate-180'"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                            d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                            fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div class="w-full">
                        <h4
                            class="mt-1 text-lg font-semibold text-black "
                            >
                            How do I complete the entry form?
                        </h4>
                    </div>
                </button>
                <div x-show="openFaq5" class="faq-content pl-[62px]">
                    <p
                        class="py-3 text-base leading-relaxed text-body-color"
                        >
                        Navigate to the <a class="italic text-blue-500 underline" href="{{ URL('entry')}}">entry form</a> page. Input your contact information, or input information on behalf of somebody else you wish to enter for. You can also select <em>Quick Pick</em> at this point(see below). Next begin typing the name of your predicted winner for the relevant event, as you type the system will generate a pick list from which you can make your selection. If you leave a field blank, our <em>Quick Pick Algorithm</em> will generate a selection for you for that event.
                    </p>
                </div>
                </div>
                <div
                class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8"
                >
                <button
                    class="flex w-full text-left faq-btn"
                    @click="openFaq6 = !openFaq6"
                    >
                    <div
                        class="bg-primary/5text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg"
                        >
                        <svg
                            :class="openFaq6 && 'rotate-180'"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                            d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                            fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div class="w-full" id="quick-pick-question">
                        <h4
                            class="mt-1 text-lg font-semibold text-black "
                            >
                            What is a Quick Pick?
                        </h4>
                    </div>
                </button>
                <div x-show="openFaq6" class="faq-content pl-[62px]">
                    <p
                        class="py-3 text-base leading-relaxed text-body-color"
                        >
                        You can select Quick Pick for as many or as few of the competitions as you want. If you select quick pick, our algorithm will generate a random entry from the list of favourites for that competition. If you select the Quick Pick checkbox on the first section of the entry form blank the entire form will be completed for you in this manner.
                    </p>
                </div>
                </div>
                <div
                class="w-full p-4 mb-8 bg-white rounded-lg shadow-[0px_20px_95px_0px_rgba(201,203,204,0.30)] sm:p-8 lg:px-6 xl:px-8"
                >
                <button
                    class="flex w-full text-left faq-btn"
                    @click="openFaq8 = !openFaq8"
                    >
                    <div
                        class="bg-primary/5 text-primary mr-5 flex h-10 w-full max-w-[40px] items-center justify-center rounded-lg"
                        >
                        <svg
                            :class="openFaq8 && 'rotate-180'"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                            d="M11 15.675C10.7937 15.675 10.6219 15.6062 10.45 15.4687L2.54374 7.69998C2.23436 7.3906 2.23436 6.90935 2.54374 6.59998C2.85311 6.2906 3.33436 6.2906 3.64374 6.59998L11 13.7844L18.3562 6.53123C18.6656 6.22185 19.1469 6.22185 19.4562 6.53123C19.7656 6.8406 19.7656 7.32185 19.4562 7.63123L11.55 15.4C11.3781 15.5719 11.2062 15.675 11 15.675Z"
                            fill="currentColor"
                            />
                        </svg>
                    </div>
                    <div class="w-full">
                        <h4
                            class="mt-1 text-lg font-semibold text-black "
                            >
                            How much does it cost to enter?
                        </h4>
                    </div>
                </button>
                <div x-show="openFaq8" class="faq-content pl-[62px]">
                    <p
                        class="py-3 text-base leading-relaxed text-body-color"
                        >
                        Entries cost €10.00 each, or you can avail of our <strong>Buy 2 Get 1 Free Offer</strong>, of 3 entries for €20.00.
                    </p>
                </div>
                </div>
            </div>
        </div>
    </div>
    <section id="Scoring">
        <h1 class="p-3 text-3xl font-bold text-center custom-red-text">Events in 2024 Competition</h1>
        <p class="p-3 text-xl">Below are the events which are in the 2024 Champ or Chimp Competition</p>
        <div class="grid grid-cols-1 mx-auto my-5 shadow-md lg:grid-cols-3">
            <div class="p-10 mx-3 bg-white rounded-lg shadow-lg">
                <h2 class="mb-2 text-2xl font-bold custom-red-text">Cateogry A</h2>
                <p class="text-gray-700">Cheltenham Champion Hurdle</p>
                <p class="text-gray-700">Cheltenham Gold Cup</p>
            </div>
            <div class="p-10 mx-3 bg-white rounded-lg shadow-lg">
                <h2 class="mb-2 text-2xl font-bold custom-red-text">Cateogry B</h2>
                <p class="text-gray-700">Champions Cup Rugby</p>
                <p class="text-gray-700">Champions League Football</p>
                <p class="text-gray-700">Wimbledon Ladies Tennis</p>
                <p class="text-gray-700">Wimbledon Mens tennis</p>
                <p class="text-gray-700">All-Ireland Senior Hurling</p>
                <p class="text-gray-700">All-Ireland Senior Football</p>
                <p class="text-gray-700">All-Ireland Senior Ladies Gaelic Football</p>
                <p class="text-gray-700">All-Ireland Senior Camogie</p>
            </div>
            <div class="p-10 mx-3 bg-white rounded-lg shadow-lg">
                <h2 class="mb-2 text-2xl font-bold custom-red-text">Cateogry C</h2>
                <p class="text-gray-700">US Masters</p>
                <p class="text-gray-700">US PGA</p>
                <p class="text-gray-700">US Open Golf</p>
                <p class="text-gray-700">Brittish Open Golf</p>
            </div>
        </div>
        <div>
            <h1 class="p-3 text-3xl font-bold text-center custom-red-text">Scoring Scheme</h1>
            <p class="p-3 text-xl">Events are grouped into catagories for the purpose of awarding points. There are 3 Catagories ("A", "B", "C") based on the format of the event and the degree of difficulty in predicting the winner. See below for details.</p>
        </div>
        <div class="relative max-w-lg mx-auto overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right ">
                <thead class="text-gray-800 uppercase text-s bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            A
                        </th>
                        <th scope="col" class="px-6 py-3">
                            B
                        </th>
                        <th scope="col" class="px-6 py-3">
                            C
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b odd:bg-white even:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Winner
                        </th>
                        <td class="px-6 py-4">
                            70
                        </td>
                        <td class="px-6 py-4">
                            70
                        </td>
                        <td class="px-6 py-4">
                            100
                        </td>
                    </tr>
                    <tr class="border-b odd:bg-white even:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Runner Up
                        </th>
                        <td class="px-6 py-4">
                            40
                        </td>
                        <td class="px-6 py-4">
                            40
                        </td>
                        <td class="px-6 py-4">
                            70
                        </td>
                    </tr>
                    <tr class="border-b odd:bg-white even:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Beaten S/F
                        </th>
                        <td class="px-6 py-4">
                            25
                        </td>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                    </tr>
                    <tr class="border-b odd:bg-white even:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            3rd Place
                        </th>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            30
                        </td>
                        <td class="px-6 py-4">
                            60
                        </td>
                    </tr>
                    <tr class="border-b odd:bg-white even:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            4th Place
                        </th>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            20
                        </td>
                        <td class="px-6 py-4">
                            50
                        </td>
                    </tr>
                    <tr class="border-b odd:bg-white even:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            5th Place
                        </th>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            40
                        </td>
                    </tr>
                    <tr class="border-b odd:bg-white even:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            6th Place
                        </th>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            30
                        </td>
                    </tr>
                    <tr class="border-b odd:bg-white even:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            7th Place
                        </th>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            20
                        </td>
                    </tr>
                    <tr class="border-b odd:bg-white even:bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            8th Place
                        </th>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            N/A
                        </td>
                        <td class="px-6 py-4">
                            10
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section id="HeroButton">
        <div class="flex flex-col items-center pb-10">
            <!-- Help text -->
            <h1 class="p-3 text-3xl font-bold text-center custom-red-text">Think you're ready?</h1>

            @if (auth()->guest())
                <p class="p-3 text-xl">Login or create an account to submit an entry form!</p>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    <button type="button" class="h-10 px-2 mx-2 text-base font-medium border border-gray-700 rounded-e hover:bg-gray-900 hover:text-white">
                        <a href="{{ URL('register') }}">Register</a>
                    </button>

                    <button type="button" class="h-10 px-2 mx-2 text-base font-medium border border-gray-700 rounded-e hover:bg-gray-900 hover:text-white">
                        <a href="{{ URL('login') }}">Login</a>
                    </button>
                </div>
            @else
                <p class="p-3 text-xl">Hi {{Auth::user()->first_name}}, submit a form here!</p>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    <button type="button" id="custom-red-button" class="h-10 px-2 mx-2 text-base font-medium text-white border border-gray-700 rounded-e hover:bg-gray-900 hover:text-white ">
                        <a href="{{ URL('entry') }}">Entry Form</a>
                    </button>
                </div>
            @endif



        </div>
    </section>
</div>
