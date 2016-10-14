<a target="_blank" href="http://stackoverflow.com/search?q={{ $error->getMessage() }} ">{{ $error->getMessage() }}<a/>
<span> {{ $error->getFile() }} +{{ $error->getLine() }} </span>
