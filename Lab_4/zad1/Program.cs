using System;

namespace zad1
{
    class Program
    {
        static void Main(string[] args)
        {
            var binding = new System.ServiceModel.BasicHttpBinding();
            binding.Name = "simpleService_webservices";
            binding.Namespace = "pl.pc.wat.ppr.wsdl";
            var endpointAddress = new System.ServiceModel.EndpointAddress(new Uri("http://127.0.0.1:1234"));
            var ssr = new ServiceReference.simpleServiceClient(binding,endpointAddress);
            var req = new ServiceReference.getSumRequest(args[0], args[1]);
            var result = ssr.getSumAsync(args[0], args[1]);
            result.Wait();
            Console.WriteLine("Suma:");
            Console.WriteLine(result.ToString());
            Console.WriteLine(result.Result.sum);
        }
    }
}
