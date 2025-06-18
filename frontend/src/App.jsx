import { useState } from "react";
import { Calendar } from "@/components/ui/calendar";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Card } from "@/components/ui/card";
import Navbar from "@/components/ui/Navbar";
import { format } from "date-fns";

function App() {
  const [date, setDate] = useState(new Date());
  const [city, setCity] = useState("");
  const [products, setProducts] = useState([]);

  const fetchRecommendations = async () => {
    const formattedDate = format(date, "yyyy-MM-dd");

    const response = await fetch("http://localhost:8000/api/recommendations", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        weather: { city },
        date: formattedDate,
      }),
    });

    const data = await response.json();
    setProducts(data.products || []);
  };

  return (
    <>
      <Navbar />
      <main className="min-h-screen bg-gray-50 dark:bg-gray-900 py-10 px-4 flex justify-center">
        <div className="w-full max-w-2xl flex flex-col items-center gap-6">

          {/* Ville */}
          <div className="w-full flex flex-col items-center">
            <label className="block text-sm font-medium mb-2 text-center text-gray-800 dark:text-gray-200">
              Ville
            </label>
            <Input
              value={city}
              onChange={(e) => setCity(e.target.value)}
              placeholder="Ex: Paris"
              className="text-center bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600"
            />
          </div>

          {/* Calendrier */}
<div className="w-full flex flex-col items-center">
  <label className="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300 self-start">
    Date
  </label>
  <div className="rounded-md border bg-white text-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100 p-2">
    <Calendar
      mode="single"
      selected={date}
      onSelect={setDate}
      className="text-gray-900 dark:text-gray-100"
    />
  </div>
</div>

          {/* Bouton */}
          <Button
            onClick={fetchRecommendations}
            className="mt-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white"
          >
            Obtenir les recommandations
          </Button>

          {/* Cartes */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8 w-full">
            {products.map((product, index) => (
              <Card
                key={index}
                className="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700"
              >
                <div className="p-4">
                  <h2 className="text-lg font-semibold text-gray-800 dark:text-white">
                    {product.name}
                  </h2>
                  <p className="text-gray-600 dark:text-gray-300">{product.price} €</p>
                </div>
              </Card>
            ))}
          </div>
        </div>
      </main>
    </>
  );
}

export default App;
