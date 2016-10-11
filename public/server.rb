require 'sinatra'
require 'json'

post '/payload' do
    push = JSON.parse(request.body.read)
    puts push
end

get '/payload' do
    "Hello World!"
end