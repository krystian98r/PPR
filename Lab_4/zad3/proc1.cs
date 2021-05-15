using System;

namespace zad1
{
    class proc1
    {
        static void Main(string[] args)
        {
            var binding = new System.ServiceModel.BasicHttpBinding();
            binding.Name = "simpleService_webservices";
            binding.Namespace = "pl.pc.wat.ppr.wsdl";
            var endpointAddress = new System.ServiceModel.EndpointAddress(new Uri("http://127.0.0.1:1234"));
            var ssr = new ServiceReference.sendMessageClient(binding,endpointAddress);
            for(;;) {
                Console.WriteLine("Enter message:");
                var req = new ServiceReference.sendMessageRequest(Console.ReadLine());
                var result = ssr.sendMessageAsync(req);
                result.Wait();
            }
        }
    }
}
