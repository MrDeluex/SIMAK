import { useState, useEffect } from "react";

const UserManagement = () => {
  const [users, setUsers] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [entries, setEntries] = useState(5);
  const [search, setSearch] = useState("");
  const [role, setRole] = useState("");
  const [selectedUser, setSelectedUser] = useState(null);

  useEffect(() => {
    fetchData();
  }, [currentPage, entries, search, role]);

  const fetchData = async () => {
    try {
      const response = await fetch("https://backend-simak.trihech.my.id/api/admin/users", {
        method: "GET",
        headers: {
          Authorization: `Bearer ${sessionStorage.getItem("api_token")}`,
        },
      });
      if (!response.ok) throw new Error("Failed to fetch data");

      const data = await response.json();
      let filteredData = data.data.filter(
        (item) =>
          item.role.toLowerCase().includes(search.toLowerCase()) &&
          (role === "" || item.role === role)
      );
      setUsers(filteredData);
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  };

  const viewDetail = async (id) => {
    try {
      const response = await fetch(`https://backend-simak.trihech.my.id/api/admin/users/${id}`, {
        method: "GET",
        headers: {
          Authorization: `Bearer ${sessionStorage.getItem("api_token")}`,
        },
      });
      if (!response.ok) throw new Error("Failed to fetch details");
      const detailData = await response.json();
      setSelectedUser(detailData);
    } catch (error) {
      console.error("Error fetching details:", error);
    }
  };

  return (

    <div className="p-4 shadow-md bg-white rounded-lg">
      <div className="flex justify-between items-center mb-4">
        <div>
          <label className="mr-2">Show</label>
          <select value={entries} onChange={(e) => setEntries(Number(e.target.value))} className="border px-2 rounded">
            <option value="5">5</option>
            <option value="10">10</option>
          </select>
          <span className="ml-2">entries</span>
        </div>
        <div>
          <label className="mr-2">Search:</label>
          <input type="text" value={search} onChange={(e) => setSearch(e.target.value)} className="border px-2 rounded" />
        </div>
      </div>
      <div className="overflow-y-auto h-80">
        <table className="w-full border">
          <thead className="bg-gray-200">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {users.map((user) => (
              <tr key={user.id}>
                <td className="text-center">{user.id}</td>
                <td>{user.nama_lengkap}</td>
                <td>{user.email}</td>
                <td>{user.role}</td>
                <td className="text-center">
                  <button onClick={() => viewDetail(user.id)} className="px-2 py-1 bg-blue-500 text-white rounded">View</button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
      {selectedUser && (
        <div className="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
          <div className="bg-white p-4 rounded shadow-md">
            <h2 className="text-lg font-bold">User Detail</h2>
            <p>ID: {selectedUser.id}</p>
            <p>Name: {selectedUser.nama_lengkap}</p>
            <p>Role: {selectedUser.role}</p>
            <p>Description: {selectedUser.description || "No description available"}</p>
            <button onClick={() => setSelectedUser(null)} className="mt-2 px-4 py-2 bg-red-500 text-white rounded">Close</button>
          </div>
        </div>
      )}
    </div>

    




  );
};

export default UserManagement;
