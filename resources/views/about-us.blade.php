@extends('layouts.layout')

@section('content')
    <div class="max-w-7xl mx-auto py-32 px-6 xl:px-8">
        <div class="gap-x-14 max-w-2xl mx-auto xl:flex xl:items-center xl:max-w-none xl:mx-0">
            <div class="shrink-0 w-full max-w-xl">
                <p class="text-2xl font-semibold text-gray-900">Sobre Estación Arcoiris Kids</p>
                <h1 class="mt-4 text-5xl font-semibold text-gray-900">Creadores de sonrisas y momentos inolvidables para los más pequeños.</h1>
                <p class="relative mt-6 text-xl text-gray-600 md:max-w-md xl:max-w-none">Somos una empresa dedicada a la recreación infantil atreves de juegos inflables, piscina de pelotas, zona de arte y demás. Con una amplia trayectoria en el campo. Contribuyendo al sano esparcimiento de nuestros niños, ofreciendo productos y servicios para eventos infantiles empresariales, fiestas, colegios y público en general.</p>
            </div>
            <div class="flex justify-end gap-8 mt-14 md:justify-start md:-mt-44 md:pl-20 xl:mt-0 xl:pl-0">
                <div class="flex-none w-44 ml-auto pt-32 md:ml-0 md:pt-80 xl:pt-36 xl:order-last">
                    <div class="relative">
                        <img src="{{ asset('images/d.jpg') }}" class="aspect-[2/3] w-full bg-gray-900/[0.05] object-cover rounded-xl shadow-lg">
                        <div class="absolute inset-0 ring-1 ring-inset ring-gray-900/[0.1] rounded-xl"></div>
                    </div>
                </div>
                <div class="flex-none space-y-8 w-44 mr-auto md:mr-0 md:pt-52 xl:pt-36">
                    <div class="relative">
                        <img src="{{ asset('images/e.jpg') }}" class="aspect-[2/3] w-full bg-gray-900/[0.05] object-cover rounded-xl shadow-lg">
                        <div class="absolute inset-0 ring-1 ring-inset ring-gray-900/[0.1] rounded-xl"></div>
                    </div>
                    <div class="relative">
                        <img src="{{ asset('images/f.jpg') }}" class="aspect-[2/3] w-full bg-gray-900/[0.05] object-cover rounded-xl shadow-lg">
                        <div class="absolute inset-0 ring-1 ring-inset ring-gray-900/[0.1] rounded-xl"></div>
                    </div>
                </div>
                <div class="flex-none space-y-8 w-44 pt-32 md:pt-0">
                    <div class="relative">
                        <img src="{{ asset('images/g.jpg') }}" class="aspect-[2/3] w-full bg-gray-900/[0.05] object-cover rounded-xl shadow-lg">
                        <div class="absolute inset-0 ring-1 ring-inset ring-gray-900/[0.1] rounded-xl"></div>
                    </div>
                    <div class="relative">
                        <img src="{{ asset('images/h.jpg') }}" class="aspect-[2/3] w-full bg-gray-900/[0.05] object-cover rounded-xl shadow-lg">
                        <div class="absolute inset-0 ring-1 ring-inset ring-gray-900/[0.1] rounded-xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl -mt-12 mx-auto px-6 md:mt-0 xl:px-8">
        <div class="max-w-2xl mx-auto xl:max-w-none xl:mx-0">
            <div class="grid grid-cols-1 gap-8 max-w-xl md:max-w-none xl:grid-cols-2">
                <div>
                    <h3 class="text-4xl font-semibold text-gray-900">Misión</h3>
                    <p class="relative mt-6 text-xl text-gray-600">En Estación Arcoiris Kids, nuestra misión es establecer espacios de juego que inspiren a los niños a divertirse, compartir y fomentar buena relación con otros infantes y ofrecemos servir al cliente para que tenga una experiencia única con nuestro servicio.</p>
                </div>
                <div>
                    <h3 class="text-4xl font-semibold text-gray-900">Visión</h3>
                    <p class="relative mt-6 text-xl text-gray-600">Queremos ser reconocidos por nuestra excelente selección de juegos de alta calidad y por proporciona un servicio excepcional a nuestros clientes. Nos comprometemos a ser líderes en el mercado, ofreciendo constantemente nuevas y emocionantes opciones de juego para satisfacer las necesidades y los intereses cambiantes de los niños.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-32">
        <img src="{{ asset('images/i.jpg') }}" class="aspect-[5/2] w-full object-cover">
    </div>
    <div class="max-w-7xl my-32 mx-auto px-6 xl:px-8">
        <h3 class="text-4xl font-semibold text-gray-900">Nuestros valores</h3>
        <dl class="grid grid-cols-1 gap-x-8 gap-y-16 max-w-2xl mt-6 mx-auto text-xl md:grid-cols-2 xl:grid-cols-3 xl:max-w-none xl:mx-0">
            <div>
                <dt class="font-semibold text-gray-900">Diversión y alegría</dt>
                <dd class="mt-1 text-gray-600">Proporcionar experiencias de recreación que sean divertidas, alegres y llenas de emoción para los niños.</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-900">Seguridad</dt>
                <dd class="mt-1 text-gray-600">Garantizar un ambiente seguro y protegido donde los niños puedan disfrutar sin preocupaciones.</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-900">Creatividad e imaginación</dt>
                <dd class="mt-1 text-gray-600">Fomentar la creatividad y la imaginación de los niños a través de juegos y actividades que estimulen su mente.</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-900">Inclusión</dt>
                <dd class="mt-1 text-gray-600">Asegurarse de que todos los niños, independientemente de sus capacidades o necesidades, puedan participar y disfrutar de las actividades.</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-900">Calidad del servicio</dt>
                <dd class="mt-1 text-gray-600">Ofrecer un servicio de alta calidad en todas las interacciones con los clientes y brindar una experiencia memorable.</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-900">Trabajo en equipo</dt>
                <dd class="mt-1 text-gray-600">Fomentar un ambiente colaborativo donde los empleados trabajen juntos para lograr los objetivos comunes.</dd>
            </div>
        </dl>
    </div>
@stop
