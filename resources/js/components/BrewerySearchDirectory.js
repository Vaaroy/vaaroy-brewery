import React, { useState } from 'react';

const BrewerySearchDirectory= () => {
  const [searchTerm, setSearchTerm] = useState('');
  const [breweries, setBreweries] = useState([]);

  const handleSearch = async () => {
    try {
      const response = await fetch(`/api/breweries?search=${searchTerm}`);
      const data = await response.json();
      setBreweries(data);
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <input
        type="text"
        placeholder="Search Breweries..."
        value={searchTerm}
        onChange={(e) => setSearchTerm(e.target.value)}
      />
      <button onClick={handleSearch}>Search</button>

      <ul>
        {breweries.map((brewery) => (
          <li key={brewery.id}>
            <h3>{brewery.name}</h3>
            <p>Type: {brewery.type}</p>
            <p>Address: {brewery.address.street}, {brewery.address.city}, {brewery.address.state}, {brewery.address.postal_code}</p>
            <p>Country: {brewery.country}</p>
            <p>Phone: {brewery.phone}</p>
            <p>Website: <a href={brewery.website}>{brewery.website}</a></p>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default BrewerySearchDirectory;