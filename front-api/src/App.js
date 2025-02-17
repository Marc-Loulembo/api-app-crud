import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import { ItemsProvider } from './ItemsContext';
import Home from './pages/Home';
import ItemsList from './pages/ItemsList';
import CreateItem from './pages/CreateItem';
import UpdateItem from './pages/UpdateItem';

function App() {
  return (
    <ItemsProvider>
      <Router>
        <nav>
          <Link to="/">Accueil</Link> |{' '}
          <Link to="/items">Listes de course</Link> |{' '}
          <Link to="/create">Créer une liste de courses</Link>
        </nav>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/items" element={<ItemsList />} />
          <Route path="/create" element={<CreateItem />} />
          <Route path="/update/:id" element={<UpdateItem />} />
        </Routes>
      </Router>
    </ItemsProvider>
  );
}

export default App;
